<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Amenity;

class AmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $amenities = [
            ['name' => 'Wi-Fi', 'icon' => 'fa-wifi'],
            ['name' => 'TV', 'icon' => 'fa-tv'],
            ['name' => 'Air Conditioning', 'icon' => 'fa-snowflake'],
            ['name' => 'Mini Bar', 'icon' => 'fa-glass-whiskey'],
            ['name' => 'Safe', 'icon' => 'fa-lock'],
            ['name' => 'Hair Dryer', 'icon' => 'fa-wind'],
            ['name' => 'Coffee Maker', 'icon' => 'fa-coffee'],
            ['name' => 'Iron', 'icon' => 'fa-iron'],
            ['name' => 'Bathtub', 'icon' => 'fa-bath'],
            ['name' => 'Balcony', 'icon' => 'fa-door-open'],
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }
    }
}
