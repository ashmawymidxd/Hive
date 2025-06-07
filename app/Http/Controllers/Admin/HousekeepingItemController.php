<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\HousekeepingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HousekeepingItemController extends Controller
{
    public function index()
    {
        $totalItems = HousekeepingItem::count();
        $items = HousekeepingItem::all();
        return response()->json([
            'totalItems' => $totalItems,
            'items' => $items
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['status'] = $this->calculateStatus($request->quantity);
        
        $item = HousekeepingItem::create($data);

        return response()->json([
            'message' => 'Housekeeping item created successfully',
            'item' => $item,
            'totalItems' => HousekeepingItem::count()
        ]);
    }

    public function show(HousekeepingItem $housekeepingItem)
    {
        return response()->json($housekeepingItem);
    }

    public function update(Request $request, HousekeepingItem $housekeepingItem)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['status'] = $this->calculateStatus($request->quantity);
        
        $housekeepingItem->update($data);

        return response()->json([
            'message' => 'Housekeeping item updated successfully',
            'item' => $housekeepingItem
        ]);
    }

    public function destroy(HousekeepingItem $housekeepingItem)
    {
        $housekeepingItem->delete();
        return response()->json([
            'message' => 'Housekeeping item deleted successfully',
            'totalItems' => HousekeepingItem::count()
        ]);
    }

    private function calculateStatus($quantity)
    {
        return $quantity > 50 ? 'In Stock' : 
              ($quantity > 10 ? 'Low Stock' : 'Critical Stock');
    }

    public function alerts()
    {
        $activeAlerts = HousekeepingItem::where('needs_restock', true)->count();
        $alertItems = HousekeepingItem::where('needs_restock', true)
                        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
                        ->get();

        return response()->json([
            'activeAlerts' => $activeAlerts,
            'alertItems' => $alertItems
        ]);
    }

    public function updateReorderPoint(Request $request, HousekeepingItem $housekeepingItem)
    {
        $validator = Validator::make($request->all(), [
            'reorder_point' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $housekeepingItem->update(['reorder_point' => $request->reorder_point]);

        return response()->json([
            'message' => 'Reorder point updated successfully',
            'item' => $housekeepingItem
        ]);
    }
}