<?php

// database/factories/InventoryFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    public function definition()
    {
        $categories = ['Food', 'Beverage', 'Cleaning Supplies', 'Office Supplies', 'Toiletries'];
        $units = ['pcs', 'kg', 'liter', 'box', 'pack'];
        $statuses = ['In Stock', 'Low Stock', 'Out of Stock'];

        return [
            'name' => $this->faker->word(),
            'category' => $this->faker->randomElement($categories),
            'quantity' => $this->faker->numberBetween(0, 100),
            'unit' => $this->faker->randomElement($units),
            'status' => $this->faker->randomElement($statuses),
        ];
    }
}