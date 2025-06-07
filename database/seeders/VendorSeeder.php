<?php

// database/seeders/VendorSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorSeeder extends Seeder
{
    public function run()
    {
        Vendor::factory()->count(50)->create();
    }
}
