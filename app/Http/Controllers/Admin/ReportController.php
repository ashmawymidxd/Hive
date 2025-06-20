<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OccupancyRecord;

class ReportController extends Controller
{
    public function index(){
         // Current occupancy (latest record)
        $currentOccupancy = OccupancyRecord::latest('record_date')->first();

        // Calculate average length of stay (this would need to come from another model)
        // For demonstration, I'm using a placeholder value
        $averageStay = 3.2; // You would calculate this from reservation data

        // Highest occupancy day (example calculation)
        $highestDay = OccupancyRecord::selectRaw('DAYNAME(record_date) as day_name, AVG(occupancy_rate) as avg_rate')
            ->groupBy('day_name')
            ->orderByDesc('avg_rate')
            ->first();

        return view('admin.pages.reports.index', [
            'currentOccupancy' => $currentOccupancy,
            'averageStay' => $averageStay,
            'averageStayChange' => 0.4, // This would be calculated
            'highestDay' => $highestDay ? $highestDay->day_name : 'Saturday',
            'highestDayRate' => $highestDay ? round($highestDay->avg_rate) : 95,
            'occupancyChange' => $this->calculateOccupancyChange(),
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
