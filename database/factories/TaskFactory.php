<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $statuses = ['pending', 'in_progress', 'completed', 'overdue'];
        $priorities = ['low', 'medium', 'high'];

        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'staff_id' => Staff::inRandomOrder()->first()->id ?? Staff::factory()->create()->id,
            'assigned_by' => Staff::inRandomOrder()->first()->id ?? Staff::factory()->create()->id,
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'status' => $this->faker->randomElement($statuses),
            'priority' => $this->faker->randomElement($priorities),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
