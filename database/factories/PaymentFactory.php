<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition()
    {
        return [
            'payment_number' => 'PAY-' . now()->format('Y') . '-' . $this->faker->unique()->numberBetween(100, 999),
            'invoice_id' => \App\Models\Invoice::inRandomOrder()->first()->id,
            'guest_id' => \App\Models\Guest::inRandomOrder()->first()->id,
            'amount' => $this->faker->randomFloat(2, 50, 2000),
            'payment_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'payment_method' => $this->faker->randomElement(['Credit Card', 'Bank Transfer', 'Cash', 'PayPal']),
            'status' => $this->faker->randomElement(['completed', 'pending', 'failed']),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
