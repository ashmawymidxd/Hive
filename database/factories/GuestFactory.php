<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->optional(0.8)->address(), // 80% chance of having an address
            'city' => $this->faker->optional(0.7)->city(), // 70% chance of having a city
            'country' => $this->faker->optional(0.7)->country(), // 70% chance of having a country
            'age' => $this->faker->optional(0.1)->numberBetween(18, 99), // 10% chance of having an age
            'purpose_of_stay' => $this->faker->optional(0.7)->word(), // 70% chance of having a purpose of stay
            'is_loyalty_member' => $this->faker->boolean(30), // 30% chance of being a loyalty member
        ];
    }
}