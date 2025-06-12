<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class InvoiceFactory extends Factory
{
    public function definition()
    {
        // Get random dates within the last year
        $issueDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $dueDate = Carbon::parse($issueDate)->addDays($this->faker->numberBetween(7, 30));

        return [
            'invoice_number' => 'INV-' . $this->faker->unique()->numberBetween(1000, 9999),
            'guest_id' => \App\Models\Guest::inRandomOrder()->first()->id,
            'room_id' => \App\Models\Room::inRandomOrder()->first()->id,
            'amount' => $this->faker->randomFloat(2, 50, 1000),
            'issue_date' => $issueDate,
            'due_date' => $dueDate,
            'status' => $this->faker->randomElement(['pending', 'paid', 'overdue', 'cancelled']),
            'notes' => $this->faker->optional()->sentence(),
            'created_at' => $issueDate,
            'updated_at' => $issueDate,
        ];
    }
}
