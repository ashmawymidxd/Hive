<?php

namespace Database\Factories;

use App\Models\Guest;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {

        $checkIn = $this->faker->dateTimeBetween('now', '+1 month');
        $checkOut = $this->faker->dateTimeBetween($checkIn, '+2 months');

        return [
            'guest_id' => Guest::inRandomOrder()->first()->id ?? Guest::factory()->create()->id,
            'room_id' => Room::inRandomOrder()->first()->id ?? Room::factory()->create()->id,
            'check_in' => $checkIn->format('Y-m-d'), // Explicitly format as date
            'check_out' => $checkOut->format('Y-m-d'), // Explicitly format as date
            'status' => 'confirmed', // Default status, can be randomized if needed
            'amount' => $this->faker->randomFloat(2, 50, 500),
            'special_requests' => $this->faker->boolean(30) ? $this->faker->paragraph : null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
