<?php

// database/seeders/HousekeepingItemSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HousekeepingItem;

class HousekeepingItemSeeder extends Seeder
{
    public function run()
    {
        HousekeepingItem::factory()->count(50)->create();
    }
}