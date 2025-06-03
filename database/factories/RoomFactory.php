<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $roomTypes = ['Single', 'Double', 'Suite', 'Deluxe', 'Executive'];
        $floors = range(1, 10);
        $statuses = ['available', 'occupied', 'maintenance', 'cleaning'];
        
        return [
            'room_number' => $this->faker->unique()->regexify('[A-Z]{1}[0-9]{3}'), // e.g., A101, B205, etc.
            'type' => $this->faker->randomElement($roomTypes),
            'floor' => (string)$this->faker->randomElement($floors),
            'status' => $this->faker->randomElement($statuses),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'description' => $this->faker->optional(0.7)->sentence(), // 70% chance of having a description
            'capacity' => $this->faker->numberBetween(1, 4),
        ];
    }
}