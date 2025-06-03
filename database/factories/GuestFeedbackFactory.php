<?php

namespace Database\Factories;

use App\Models\Guest;
use App\Models\Reservation;
use App\Models\GuestFeedback;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestFeedbackFactory extends Factory
{
    protected $model = GuestFeedback::class;

    public function definition()
    {
        $types = ['feedback', 'complaint', 'suggestion'];
        $categories = ['cleanliness', 'service', 'amenities', 'food', 'staff', null];
        $statuses = ['pending', 'acknowledged', 'resolved', 'rejected'];
        
        return [
            'guest_id' => Guest::factory(),
            'reservation_id' => $this->faker->optional(0.7)->randomElement(Reservation::pluck('id')->toArray()),
            'type' => $this->faker->randomElement($types),
            'category' => $this->faker->randomElement($categories),
            'message' => $this->faker->paragraphs($this->faker->numberBetween(1, 3), true),
            'status' => $this->faker->randomElement($statuses),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    // State methods for specific types
    public function feedback()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'feedback',
            ];
        });
    }

    public function complaint()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'complaint',
            ];
        });
    }

    public function suggestion()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'suggestion',
            ];
        });
    }

    // State methods for statuses
    public function pending()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'pending',
            ];
        });
    }

    public function acknowledged()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'acknowledged',
            ];
        });
    }

    public function resolved()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'resolved',
            ];
        });
    }

    public function rejected()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'rejected',
            ];
        });
    }
}