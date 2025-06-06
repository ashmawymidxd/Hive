<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create sample reservations
        Reservation::create([
            'guest_id' => 1,
            'room_id' => 1,
            'check_in' => Carbon::today(),
            'check_out' => Carbon::today()->addDays(3),
            'status' => 'confirmed',
            'amount' => 299.99,
            'special_requests' => 'Please provide extra towels and a baby cot.'
        ]);


        // Create random reservations
        Reservation::factory()->count(20)->create();
    }
}
