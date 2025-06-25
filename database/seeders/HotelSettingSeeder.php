<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HotelSetting;

class HotelSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Check if settings already exist
        if (HotelSetting::count() === 0) {
            HotelSetting::factory()->create([
                'hotel_name' => 'Hive',
                'logo_path' => 'assets/admin/images/hotel_logo/default.png'
            ]);
        }
    }
}
