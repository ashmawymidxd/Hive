<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\OccupancyRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OccupancyDataController extends Controller
{
    public function getOccupancyData($period = 'daily')
    {
        $now = Carbon::now();
        $data = [];
        $labels = [];

        switch ($period) {
            case 'weekly':
                // Get data for last 8 weeks (to show 7 full weeks)
                $startDate = $now->copy()->subWeeks(7)->startOfWeek();
                $endDate = $now->copy()->endOfWeek();

                $records = OccupancyRecord::whereBetween('record_date', [$startDate, $endDate])
                    ->orderBy('record_date')
                    ->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->record_date)->format('W-Y');
                    });

                foreach ($records as $week => $weekRecords) {
                    $weekNumber = explode('-', $week)[0];
                    $year = explode('-', $week)[1];
                    $labels[] = "Week $weekNumber, $year";

                    $avgRate = $weekRecords->avg('occupancy_rate');
                    $data[] = round($avgRate, 2);
                }
                break;

            case 'monthly':
                // Get data for last 12 months
                $startDate = $now->copy()->subMonths(11)->startOfMonth();
                $endDate = $now->copy()->endOfMonth();

                $records = OccupancyRecord::whereBetween('record_date', [$startDate, $endDate])
                    ->orderBy('record_date')
                    ->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->record_date)->format('m-Y');
                    });

                foreach ($records as $month => $monthRecords) {
                    $monthNumber = explode('-', $month)[0];
                    $year = explode('-', $month)[1];
                    $labels[] = Carbon::createFromDate($year, $monthNumber, 1)->format('M Y');

                    $avgRate = $monthRecords->avg('occupancy_rate');
                    $data[] = round($avgRate, 2);
                }
                break;

            default: // daily
                // Get data for last 30 days
                $startDate = $now->copy()->subDays(7);
                $endDate = $now->copy();

                $records = OccupancyRecord::whereBetween('record_date', [$startDate, $endDate])
                    ->orderBy('record_date')
                    ->get();

                foreach ($records as $record) {
                    $labels[] = $record->record_date->format('M j');
                    $data[] = $record->occupancy_rate;
                }
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'period' => $period
        ]);
    }
}
