<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ExpenseCategory;
use App\Models\Department;

class ExpenseFactory extends Factory
{
    protected static $currentSequence = 1;

    public function definition()
    {
        return [
            'expense_number' => function() {
                return 'EXP-'.date('Y').'-'.str_pad(self::$currentSequence++, 3, '0', STR_PAD_LEFT);
            },
            'category_id' => ExpenseCategory::factory(),
            'department_id' => Department::factory(),
            'description' => $this->generateDescription(),
            'amount' => $this->faker->randomFloat(2, 10, 5000),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
        ];
    }

    protected function generateDescription()
    {
        $items = ['Office chairs', 'Laptop', 'Printer ink', 'Stationery', 'Software license'];
        $verbs = ['Purchase of', 'Payment for', 'Expense on'];
        
        return $verbs[array_rand($verbs)] . ' ' . $items[array_rand($items)];
    }
}