<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OccupancyRecord;
use Illuminate\Http\Request;

class ReportsChartController extends Controller
{
    public function monthlyOccupancyData(Request $request)
    {
        // Get current year or year from request
        $year = $request->input('year', date('Y'));

        // Get monthly occupancy data
        $monthlyData = OccupancyRecord::selectRaw('
                MONTH(record_date) as month,
                AVG(occupancy_rate) as avg_occupancy
            ')
            ->whereYear('record_date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Initialize array with all months at 0
        $allMonths = array_fill(1, 12, 0);

        // Fill with actual data
        foreach ($monthlyData as $data) {
            $allMonths[$data->month] = round($data->avg_occupancy, 2);
        }

        return response()->json([
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'data' => array_values($allMonths),
            'year' => $year
        ]);
    }


    public function dailyOccupancyData(Request $request)
    {
        // Get parameters from request (default to current week)
        $weekStart = $request->input('start_date', now()->startOfWeek()->format('Y-m-d'));
        $weekEnd = $request->input('end_date', now()->endOfWeek()->format('Y-m-d'));

        // Get daily occupancy data
        $dailyData = OccupancyRecord::selectRaw('
                DAYNAME(record_date) as day_name,
                DAYOFWEEK(record_date) as day_of_week,
                AVG(occupancy_rate) as avg_occupancy
            ')
            ->whereBetween('record_date', [$weekStart, $weekEnd])
            ->groupBy('day_name', 'day_of_week')
            ->orderBy('day_of_week')
            ->get();

        // Initialize array with all days at 0
        $allDays = [
            'Monday' => 0,
            'Tuesday' => 0,
            'Wednesday' => 0,
            'Thursday' => 0,
            'Friday' => 0,
            'Saturday' => 0,
            'Sunday' => 0
        ];

        // Fill with actual data
        foreach ($dailyData as $data) {
            $allDays[$data->day_name] = round($data->avg_occupancy, 2);
        }

        return response()->json([
            'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            'data' => array_values($allDays),
            'week_start' => $weekStart,
            'week_end' => $weekEnd
        ]);
    }
    
}
