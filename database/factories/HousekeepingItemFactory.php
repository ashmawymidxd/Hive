<?php

// database/factories/HousekeepingItemFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HousekeepingItemFactory extends Factory
{
    public function definition()
    {
        $categories = ['Cleaning', 'Linens', 'Amenities', 'Equipment', 'Maintenance'];
        $units = ['pcs', 'roll', 'bottle', 'set', 'pack'];
        $statuses = ['In Stock', 'Low Stock', 'Out of Stock'];
        $priorities = ['Low', 'Medium', 'High'];

        return [
            'name' => $this->faker->word(),
            'category' => $this->faker->randomElement($categories),
            'quantity' => $this->faker->numberBetween(0, 200),
            'reorder_point' => $this->faker->numberBetween(5, 20),
            'unit' => $this->faker->randomElement($units),
            'status' => $this->faker->randomElement($statuses),
            'priority' => $this->faker->randomElement($priorities),
            'needs_restock' => $this->faker->boolean(30),
            'notes' => $this->faker->optional(0.3)->sentence(),
        ];
    }
}