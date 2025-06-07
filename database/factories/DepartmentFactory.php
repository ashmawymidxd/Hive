<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Human Resources',
                'Finance',
                'Engineering',
                'Marketing',
                'Sales',
                'Customer Support',
                'Operations',
                'Product Management',
                'Research and Development',
                'Quality Assurance',
                'Management',
                'Information Technology',
                'Legal',
                'Public Relations',
                'Business Development',
                'Supply Chain',
                'Data Science',
                'Compliance',
                'Training and Development',
                'Administration',
                'Project Management',
                'Creative Services',
                'Procurement',
                'Logistics',
                'Health and Safety',
            ]),
            'description' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
