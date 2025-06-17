<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExpenseCategory;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 20 random expense categories
        ExpenseCategory::factory()->count(10)->create();
        
        // Or create specific categories if needed
        ExpenseCategory::create([
            'name' => 'Office Supplies',
            'description' => 'Pens, paper, staplers, etc.'
        ]);
        
        ExpenseCategory::create([
            'name' => 'Travel',
            'description' => 'Business travel expenses'
        ]);
        
        ExpenseCategory::create([
            'name' => 'Utilities',
            'description' => 'Electricity, water, internet'
        ]);
    }
}