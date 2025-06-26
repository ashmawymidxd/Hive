<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'discount' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'room_types' => 'required|array',
            'room_types.*' => 'string',
            'promo_code' => 'required|string|unique:promotions,promo_code',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string'
        ]);

        $promotion = Promotion::create($validated);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Promotion created successfully');
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.pages.settings.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'discount' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'room_types' => 'required|array',
            'room_types.*' => 'string',
            'promo_code' => 'required|string|unique:promotions,promo_code,'.$promotion->id,
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string'
        ]);

        $promotion->update($validated);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Promotion updated successfully');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('admin.settings.index')
            ->with('success', 'Promotion deleted successfully');
    }
}
