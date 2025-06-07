<?php

// database/factories/VendorFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class VendorFactory extends Factory
{
    public function definition()
    {
        $categories = ['Food Supplier', 'Cleaning Supplies', 'Linens', 'Equipment', 'Consumables'];
        $statuses = ['Active', 'Inactive', 'Pending Approval'];

        return [
            'name' => $this->faker->company(),
            'category' => $this->faker->randomElement($categories),
            'items_supplied' => $this->faker->numberBetween(1, 50),
            'last_order' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status' => $this->faker->randomElement($statuses),
            'contact_info' => $this->faker->optional(0.8)->paragraph(),
        ];
    }
}