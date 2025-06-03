<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Room;
use App\Models\OccupancyRecord;
use Carbon\Carbon;

class RecordDailyOccupancy extends Command
{
    protected $signature = 'occupancy:record';
    protected $description = 'Record daily occupancy rate';

    public function handle()
    {
        $totalRooms = Room::count();
        $occupiedRooms = Room::where('status', 'occupied')->count();
        $occupancyRate = $totalRooms > 0 ? ($occupiedRooms / $totalRooms) * 100 : 0;
        
        OccupancyRecord::updateOrCreate(
            ['record_date' => Carbon::today()],
            [
                'occupancy_rate' => $occupancyRate,
                'occupied_rooms' => $occupiedRooms,
                'total_rooms' => $totalRooms
            ]
        );
        
        $this->info("Daily occupancy recorded: {$occupancyRate}%");
    }
}