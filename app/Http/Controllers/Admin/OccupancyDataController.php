<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\OccupancyRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OccupancyDataController extends Controller
{
    public function getOccupancyData(Request $request)
    {
        $timeFrame = $request->input('time_frame', 'daily'); // daily, weekly, or monthly
        
        switch ($timeFrame) {
            case 'weekly':
                $data = $this->getWeeklyData();
                break;
            case 'monthly':
                $data = $this->getMonthlyData();
                break;
            default: // daily
                $data = $this->getDailyData();
        }

        return response()->json([
            'occupancy_rates' => $data['rates'],
            'labels' => $data['labels'],
            'time_frame' => $timeFrame
        ]);
    }

    protected function getDailyData()
    {
        $records = OccupancyRecord::orderBy('record_date', 'desc')
                    ->take(7)
                    ->get()
                    ->reverse()
                    ->values();

        return [
            'rates' => $records->pluck('occupancy_rate')->toArray(),
            'labels' => $records->pluck('record_date')->map(function ($date) {
                return $date->format('D, M j');
            })->toArray()
        ];
    }

    protected function getWeeklyData()
    {
        $records = OccupancyRecord::select(
                    DB::raw('YEAR(record_date) as year'),
                    DB::raw('WEEK(record_date) as week'),
                    DB::raw('AVG(occupancy_rate) as avg_rate')
                )
                ->groupBy('year', 'week')
                ->orderBy('year', 'desc')
                ->orderBy('week', 'desc')
                ->take(7)
                ->get()
                ->reverse()
                ->values();

        return [
            'rates' => $records->pluck('avg_rate')->map(function ($rate) {
                return round($rate, 2);
            })->toArray(),
            'labels' => $records->pluck('week')->map(function ($week, $index) use ($records) {
                return "Week " . $week . " (" . $records[$index]->year . ")";
            })->toArray()
        ];
    }

    protected function getMonthlyData()
    {
        $records = OccupancyRecord::select(
                    DB::raw('YEAR(record_date) as year'),
                    DB::raw('MONTH(record_date) as month'),
                    DB::raw('AVG(occupancy_rate) as avg_rate')
                )
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->take(7)
                ->get()
                ->reverse()
                ->values();

        return [
            'rates' => $records->pluck('avg_rate')->map(function ($rate) {
                return round($rate, 2);
            })->toArray(),
            'labels' => $records->map(function ($record) {
                return date('M Y', mktime(0, 0, 0, $record->month, 1, $record->year));
            })->toArray()
        ];
    }
}