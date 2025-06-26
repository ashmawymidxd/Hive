<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeasonalRatePeriod;
use Illuminate\Http\Request;

class SeasonalRatePeriodController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'rate_adjustment_type' => 'required|in:percentage,fixed,base_rate',
            'rate_adjustment_value' => 'nullable|numeric|required_if:rate_adjustment_type,percentage,fixed',
            'is_active' => 'boolean',
        ]);

        SeasonalRatePeriod::create($validated);

        return response()->json(['success' => true, 'message' => 'Seasonal rate period added successfully']);
    }

    public function show(SeasonalRatePeriod $seasonalRatePeriod)
    {
        return response()->json($seasonalRatePeriod);
    }

    public function update(Request $request, SeasonalRatePeriod $seasonalRatePeriod)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'rate_adjustment_type' => 'required|in:percentage,fixed,base_rate',
            'rate_adjustment_value' => 'nullable|numeric|required_if:rate_adjustment_type,percentage,fixed',
            'is_active' => 'boolean',
        ]);

        $seasonalRatePeriod->update($validated);

        return response()->json(['success' => true, 'message' => 'Seasonal rate period updated successfully']);
    }

    public function destroy(SeasonalRatePeriod $seasonalRatePeriod)
    {
        $seasonalRatePeriod->delete();
        return response()->json(['success' => true, 'message' => 'Seasonal rate period deleted successfully']);
    }
}
