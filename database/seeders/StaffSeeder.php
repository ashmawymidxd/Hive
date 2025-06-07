<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create specific staff members
        Staff::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'department_id' => 1, // Assuming HR is department_id 1
            'role_id' => 1, // Assuming Admin is role_id 1
            'email' => Random::generate(10, 'a-z') . '@example.com',
            'phone' => '1234567890',
            'status' => 'active',
            'hire_date' => '2020-01-01',
        ]);

        // Create random staff members
        Staff::factory()->count(10)->create();
    }
}
