<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HotelSetting>
 */
class HotelSettingFactory extends Factory
{
    public function definition()
    {
        return [
            'hotel_name' => 'Hive',
            'legal_business_name' => 'Hive Hotel Group LLC',
            'hotel_description' => 'A premium hospitality experience offering world-class amenities and services.',
            'phone_number' => $this->faker->phoneNumber,
            'email' => 'info@hivehotel.com',
            'website' => 'https://www.hivehotel.com',

            'address_line_1' => $this->faker->streetAddress,
            'address_line_2' => $this->faker->secondaryAddress,
            'city' => $this->faker->city,
            'state_province' => $this->faker->state,
            'zip_postal_code' => $this->faker->postcode,
            'country' => $this->faker->country,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,

            'star_rating' => $this->faker->numberBetween(3, 5),
            'total_rooms' => $this->faker->numberBetween(50, 300),
            'total_floors' => $this->faker->numberBetween(5, 20),
            'year_built' => $this->faker->year,
            'property_amenities' => json_encode([
                'Free WiFi',
                'Swimming Pool',
                'Fitness Center',
                'Restaurant',
                'Room Service',
                'Spa and Wellness Center',
                'Conference Rooms',
                '24/7 Front Desk',
                'Parking',
                'Airport Shuttle',
                'Laundry Service',
                'Pet-Friendly Rooms',
                'Business Center',
                'Bar/Lounge',
                'Concierge Service',
                'Daily Housekeeping',
                'Non-Smoking Rooms',
                'Family Rooms',
                'Wheelchair Accessible',
                'Air Conditioning',
                'Heating',
            ]),
            'hotel_policies' => json_encode([
                'Check-in: 3:00 PM',
                'Check-out: 11:00 AM',
                'Cancellation policy: 24 hours before arrival'
            ]),

            'tax_id' => $this->faker->uuid,
            'default_currency' => 'USD',
            'vat_tax_rate' => $this->faker->randomFloat(2, 5, 15),
            'occupancy_tax_rate' => $this->faker->randomFloat(2, 1, 5),
            'service_charge_rate' => $this->faker->randomFloat(2, 5, 10),

            'logo_path' => 'assets/admin/images/hotel_logo/default.png',
        ];
    }
}
