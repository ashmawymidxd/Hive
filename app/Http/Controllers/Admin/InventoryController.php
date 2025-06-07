<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    public function index()
    {
        $totalItems = Inventory::count();
        $inventories = Inventory::all();
        return response()->json([
            'totalItems' => $totalItems,
            'inventories' => $inventories
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['status'] = $request->quantity > 20 ? 'In Stock' : ($request->quantity > 0 ? 'Low Stock' : 'Out of Stock');
        
        $inventory = Inventory::create($data);

        return response()->json([
            'message' => 'Inventory item created successfully',
            'inventory' => $inventory,
            'totalItems' => Inventory::count()
        ]);
    }

    public function show(Inventory $inventory)
    {
        return response()->json($inventory);
    }

    public function update(Request $request, Inventory $inventory)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['status'] = $request->quantity > 20 ? 'In Stock' : ($request->quantity > 0 ? 'Low Stock' : 'Out of Stock');
        
        $inventory->update($data);

        return response()->json([
            'message' => 'Inventory item updated successfully',
            'inventory' => $inventory
        ]);
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return response()->json([
            'message' => 'Inventory item deleted successfully',
            'totalItems' => Inventory::count()
        ]);
    }
}