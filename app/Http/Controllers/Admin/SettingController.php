<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelSetting;
use Illuminate\Http\Request;
use App\Models\PricingSetting;
use App\Models\SeasonalRatePeriod;
use App\Models\Promotion;
use Illuminate\Support\Facades\DB;


class SettingController extends Controller
{
    // Pricing rules setting keys
    protected $pricingRuleKeys = [
        'weekend_rate',
        'extended_stay_discount',
        'group_booking_discount',
        'early_bird_discount',
        'loyalty_program_discount',
        'last_minute_surcharge'
    ];

    public function index()
    {
        // Get all pricing rules settings with default values
        $Pricingsettings = [];

        foreach ($this->pricingRuleKeys as $key) {
            $setting = PricingSetting::where('key', $key)->first();
            $Pricingsettings[$key] = $setting ? $setting->value : null;
        }

        $settings = HotelSetting::firstOrNew(['id' => 1]);

        $periods = SeasonalRatePeriod::all();
        $promotions = Promotion::all();


        return view('admin.pages.settings.index', compact('settings','Pricingsettings','periods','promotions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Basic Info Validation
            'hotel_name' => 'required|string|max:255',
            'legal_business_name' => 'required|string|max:255',
            'hotel_description' => 'required|string',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',

            // Location Validation
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state_province' => 'required|string|max:255',
            'zip_postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',

            // Property Details Validation
            'star_rating' => 'nullable|integer|min:1|max:5',
            'total_rooms' => 'nullable|integer|min:0',
            'total_floors' => 'nullable|integer|min:0',
            'year_built' => 'nullable|integer|min:1800|max:' . (date('Y') + 1),
            'property_amenities' => 'nullable|string',
            'hotel_policies' => 'nullable|string',

            // Tax & Financial Validation
            'tax_id' => 'nullable|string|max:50',
            'default_currency' => 'required|string|size:3|in:' . implode(',', array_keys(config('currencies'))),
            'vat_tax_rate' => 'nullable|numeric|min:0|max:100',
            'occupancy_tax_rate' => 'nullable|numeric|min:0|max:100',
            'service_charge_rate' => 'nullable|numeric|min:0|max:100',

            // Additional Fields Validation
            'hotel_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $settings = HotelSetting::firstOrNew(['id' => 1]);

        // Handle file upload

        // Delete the old logo if is set remove_logo
        if ($request->has('remove_logo') && $settings->logo_path) {
            if (file_exists(public_path($settings->logo_path))) {
                unlink(public_path($settings->logo_path));
            }
            $settings->logo_path = null; // Clear the logo path
        }
        // If a new logo is uploaded, save it
        if ($request->hasFile('hotel_logo')) {

            $file = $request->file('hotel_logo');
            $path = 'assets/admin/images/hotel_logo/' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/admin/images/hotel_logo'), $path);
            $validated['logo_path'] = $path;
        }

        $settings->fill($validated);
        $settings->save();

        HotelSetting::updateOrCreate(
            ['id' => 1], // Assuming you only have one settings record
            $validated
        );

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully');
    }

    /**
     * Update pricing rules settings
     */
    public function updatePricingRules(Request $request)
    {
        $validated = $request->validate([
            'weekend_rate' => 'nullable|string',
            'extended_stay_discount' => 'nullable|numeric',
            'group_booking_discount' => 'nullable|numeric',
            'early_bird_discount' => 'nullable|string',
            'loyalty_program_discount' => 'nullable|numeric',
            'last_minute_surcharge' => 'nullable|numeric',
        ]);

        DB::transaction(function () use ($validated) {
            foreach ($validated as $key => $value) {
                PricingSetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        });

        return redirect()->back()->with('success', 'Pricing rules updated successfully!');
    }
}
