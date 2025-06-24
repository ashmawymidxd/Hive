<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelSetting;
use Illuminate\Http\Request;


class SettingController extends Controller
{
    public function index()
    {
        $settings = HotelSetting::firstOrNew(['id' => 1]);
        return view('admin.pages.settings.index', compact('settings'));
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

        // Handle file upload at public/assets/admin/images/hotel_logo using public_path
        if ($request->hasFile('hotel_logo')) {
            //    Dletete the old logo if it exists
            if ($settings->logo_path) {
                $oldLogoPath = public_path($settings->logo_path);
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath);
                }
            }
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
}
