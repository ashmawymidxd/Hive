<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Department;
use Carbon\Carbon;

class ExpenseSeeder extends Seeder
{
    public function run()
    {
        // First create necessary categories and departments
        $categories = [
            ['name' => 'Office Supplies', 'description' => 'Office equipment'],
            ['name' => 'Travel', 'description' => 'Business trips'],
            ['name' => 'Utilities', 'description' => 'Bills and services']
        ];

        foreach ($categories as $category) {
            ExpenseCategory::firstOrCreate($category);
        }

        // Departments are created by the DepartmentFactory
        // Now create expenses safely
        Expense::factory()
            ->count(10) // Adjust number as needed
            ->create();
    }
}