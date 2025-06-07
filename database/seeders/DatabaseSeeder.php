<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run():void
    {
        $this->call([
            AdminSeeder::class,
            AmenitiesTableSeeder::class,
            RoomSeeder::class,
            GuestSeeder::class,
            GuestFeedbackSeeder::class,
            ReservationSeeder::class,
            OccupancyRecordSeeder::class,
            DepartmentSeeder::class,
            RoleSeeder::class,
            StaffSeeder::class,
            TaskSeeder::class,
            InventorySeeder::class,
            HousekeepingItemSeeder::class,
            VendorSeeder::class,
            // Other seeders...
        ]);
    }
}
