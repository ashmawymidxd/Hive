<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;                   
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AmenityController extends Controller
{
    public function index()
    {
        $amenities = Amenity::latest()->get();
        return response()->json($amenities);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:amenities',
            'icon' => 'nullable|string|max:50'
        ]);

        Amenity::create($validated);
        return response()->json(['success' => 'Amenity added successfully.']);
    }

    public function update(Request $request, Amenity $amenity)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50', Rule::unique('amenities')->ignore($amenity->id)],
            'icon' => 'nullable|string|max:50'
        ]);

        $amenity->update($validated);
        return response()->json(['success' => 'Amenity updated successfully.']);
    }

    public function destroy(Amenity $amenity)
    {
        $amenity->delete();
        return response()->json(['success' => 'Amenity deleted successfully.']);
    }
}
