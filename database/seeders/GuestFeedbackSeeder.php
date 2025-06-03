<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GuestFeedback;

class GuestFeedbackSeeder extends Seeder
{
    public function run()
    {
        // Create 50 random feedback entries
        GuestFeedback::factory()->count(50)->create();
        
        // Create specific examples
        GuestFeedback::factory()
            ->complaint()
            ->pending()
            ->create([
                'message' => 'The room was not cleaned properly when I arrived. There were stains on the sheets.',
                'category' => 'cleanliness'
            ]);
            
        GuestFeedback::factory()
            ->feedback()
            ->resolved()
            ->create([
                'message' => 'Excellent service from the front desk staff. Very helpful with local recommendations.',
                'category' => 'service'
            ]);
            
        GuestFeedback::factory()
            ->suggestion()
            ->acknowledged()
            ->create([
                'message' => 'It would be great to have more vegan options in the breakfast buffet.',
                'category' => 'food'
            ]);
            
        // Create some without reservations
        GuestFeedback::factory()
            ->count(10)
            ->create([
                'reservation_id' => null
            ]);
    }
}