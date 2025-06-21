<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OccupancyRecord;
use App\Models\Payment;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(){

        $currentOccupancy = OccupancyRecord::latest('record_date')->first();
        $averageStay = 3.2;

        $highestDay = OccupancyRecord::selectRaw('DAYNAME(record_date) as day_name, AVG(occupancy_rate) as avg_rate')
            ->groupBy('day_name')
            ->orderByDesc('avg_rate')
            ->first();

        ####### Revenue
          $currentYear = Carbon::now()->year;

        // Total Revenue (Year-to-Date)
        $ytdRevenue = Payment::whereYear('payment_date', $currentYear)
            ->where('status', 'completed')
            ->sum('amount');

        // Revenue from previous year for comparison
        $prevYearRevenue = Payment::whereYear('payment_date', $currentYear - 1)
            ->where('status', 'completed')
            ->sum('amount');

        // Calculate percentage change
        $revenueChange = $prevYearRevenue > 0
            ? (($ytdRevenue - $prevYearRevenue) / $prevYearRevenue) * 100
            : 0;

        // Calculate RevPAR (Revenue Per Available Room)
        // You'll need to adjust this based on your room count logic
        $roomCount = 50; // Example - replace with your actual room count
        $daysThisYear = Carbon::now()->dayOfYear;
        $revpar = $roomCount > 0 ? $ytdRevenue / ($roomCount * $daysThisYear) : 0;

        // Previous year RevPAR for comparison
        $prevRevpar = $roomCount > 0
            ? $prevYearRevenue / ($roomCount * 365)
            : 0;
        $revparChange = $prevRevpar > 0
            ? (($revpar - $prevRevpar) / $prevRevpar) * 100
            : 0;

        // Best performing month
        $bestMonth = Payment::selectRaw('MONTH(payment_date) as month, SUM(amount) as total')
            ->whereYear('payment_date', $currentYear)
            ->where('status', 'completed')
            ->groupBy('month')
            ->orderByDesc('total')
            ->first();

        $bestMonthName = $bestMonth ? Carbon::create()->month($bestMonth->month)->format('F') : 'N/A';
        $bestMonthRevenue = $bestMonth ? $bestMonth->total : 0;

        return view('admin.pages.reports.index', [
            'currentOccupancy' => $currentOccupancy,
            'averageStay' => $averageStay,
            'averageStayChange' => 0.4, // This would be calculated
            'highestDay' => $highestDay ? $highestDay->day_name : 'Saturday',
            'highestDayRate' => $highestDay ? round($highestDay->avg_rate) : 95,
            'occupancyChange' => $this->calculateOccupancyChange(),
            'ytdRevenue' => $ytdRevenue,
            'revenueChange' => $revenueChange,
            'revpar' => $revpar,
            'revparChange' => $revparChange,
            'bestMonthName' => $bestMonthName,
            'bestMonthRevenue' => $bestMonthRevenue,
        ]);
    }

    protected function calculateOccupancyChange()
    {
        // Calculate percentage change from last month
        $currentMonthAvg = OccupancyRecord::whereMonth('record_date', now()->month)
            ->avg('occupancy_rate');

        $lastMonthAvg = OccupancyRecord::whereMonth('record_date', now()->subMonth()->month)
            ->avg('occupancy_rate');

        if ($lastMonthAvg == 0) return 0;

        return round((($currentMonthAvg - $lastMonthAvg) / $lastMonthAvg) * 100);
    }


}
