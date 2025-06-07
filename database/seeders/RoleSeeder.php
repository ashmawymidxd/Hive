<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create predefined essential roles
        Role::create([
            'name' => 'Super Admin',
            'access_level' => 'admin',
            'permissions' => json_encode(['*']) // Encode as JSON string
        ]);

        Role::create([
            'name' => 'Department Manager',
            'access_level' => 'manager',
            'permissions' => json_encode(['create', 'read', 'update', 'manage_team'])
        ]);

        Role::create([
            'name' => 'Team Member',
            'access_level' => 'staff',
            'permissions' => json_encode(['create', 'read', 'update_own'])
        ]);

        // Create additional random roles using the factory
        Role::factory()->count(5)->create();
    }
}
