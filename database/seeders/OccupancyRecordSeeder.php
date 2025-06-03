<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OccupancyRecord;

class OccupancyRecordSeeder extends Seeder
{
    public function run(): void
    {
        // Create 365 days worth of occupancy records (past year)
        OccupancyRecord::factory()
            ->count(365)
            ->create();
    }
}