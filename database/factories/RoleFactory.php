<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $accessLevels = ['admin', 'manager', 'staff', 'editor', 'viewer'];
        $permissionsMap = [
            'admin' => ['create', 'read', 'update', 'delete', 'manage_users'],
            'manager' => ['create', 'read', 'update', 'manage_team'],
            'staff' => ['create', 'read', 'update_own'],
            'editor' => ['create', 'read', 'update'],
            'viewer' => ['read']
        ];

        $access = $this->faker->randomElement($accessLevels);
        $permissions = json_encode($permissionsMap[$access]);

        return [
            'name' => ucfirst($access) . ' Role',
            'access_level' => $access,
            'permissions' => $permissions, // Now properly encoded as JSON string
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
