<?php

namespace Database\Seeders;
// database/seeders/InventorySeeder.php

use Illuminate\Database\Seeder;
use App\Models\Inventory;

class InventorySeeder extends Seeder
{
    public function run()
    {
        Inventory::factory()->count(50)->create();
    }
}