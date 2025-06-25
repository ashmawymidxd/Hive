<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_name',
        'legal_business_name',
        'hotel_description',
        'phone_number',
        'email',
        'website',
        'address_line_1',
        'address_line_2',
        'city',
        'state_province',
        'zip_postal_code',
        'country',
        'latitude',
        'longitude',
        'star_rating',
        'total_rooms',
        'total_floors',
        'year_built',
        'property_amenities',
        'hotel_policies',
        'tax_id',
        'default_currency',
        'vat_tax_rate',
        'occupancy_tax_rate',
        'service_charge_rate',
        'logo_path'
    ];

    protected $casts = [
        'property_amenities' => 'array',
        'hotel_policies' => 'array',
        'vat_tax_rate' => 'decimal:2',
        'occupancy_tax_rate' => 'decimal:2',
        'service_charge_rate' => 'decimal:2',
    ];
}
