<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Amenity;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('amenities')->latest()->get();
        $availableRooms = Room::where('status', 'Available')->with('amenities')->latest()->get();
        $occupiedRooms = Room::where('status', 'Occupied')->with('amenities')->latest()->get();
        $maintenanceRooms = Room::where('status', 'Maintenance')->with('amenities')->latest()->get();
        $cleaningRooms = Room::where('status', 'Cleaning')->with('amenities')->latest()->get();
        $amenities = Amenity::all();
        return view('admin.pages.rooms.index', compact('rooms', 'amenities','availableRooms','occupiedRooms','maintenanceRooms','cleaningRooms'));
    }

   public function show(Room $room)
    {
        $room->load('amenities', 'images');
        return view('admin.pages.rooms.show', compact('room'));
    }

    public function uploadImages(Request $request, Room $room)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = public_path('assets/admin/img/rooms');

                // Create directory if not exists
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $image->move($path, $imageName);

                $room->images()->create([
                    'image_path' => 'assets/admin/img/rooms/' . $imageName
                ]);
            }
        }

        return redirect()->back()->with('success', 'Images uploaded successfully.');
    }

    public function deleteImage(RoomImage $image)
    {
        // Delete file from public directory
        if (file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }

        $image->delete();

        return response()->json(['success' => 'Image deleted successfully.']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|unique:rooms|max:10',
            'type' => 'required|string|max:50',
            'floor' => 'required|string|max:20',
            'status' => 'required|in:available,occupied,maintenance,cleaning',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id'
        ]);

        $room = Room::create($validated);

        if ($request->has('amenities')) {
            $room->amenities()->sync($request->amenities);
        }

        return response()->json(['success' => 'Room added successfully.']);
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_number' => ['required', 'max:10', Rule::unique('rooms')->ignore($room->id)],
            'type' => 'required|string|max:50',
            'floor' => 'required|string|max:20',
            'status' => 'required|in:available,occupied,maintenance,cleaning',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id'
        ]);

        $room->update($validated);

        $room->amenities()->sync($request->amenities ?? []);

        return response()->json(['success' => 'Room updated successfully.']);
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(['success' => 'Room deleted successfully.']);
    }


}
