<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OccupancyRecordFactory extends Factory
{
    public function definition(): array
    {
        $totalRooms = $this->faker->numberBetween(50, 300);
        $occupiedRooms = $this->faker->numberBetween(0, $totalRooms);
        $occupancyRate = ($occupiedRooms / $totalRooms) * 100;
        
        return [
            'record_date' => $this->faker->unique()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'occupancy_rate' => round($occupancyRate, 2),
            'occupied_rooms' => $occupiedRooms,
            'total_rooms' => $totalRooms,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}