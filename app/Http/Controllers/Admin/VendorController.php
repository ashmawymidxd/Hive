<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function index()
    {
        $totalVendors = Vendor::count();
        $vendors = Vendor::all();
        return response()->json([
            'totalVendors' => $totalVendors,
            'vendors' => $vendors
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'items_supplied' => 'required|integer|min:0',
            'last_order' => 'required|date',
            'contact_info' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['status'] = $request->items_supplied > 10 ? 'Active' : 'Inactive';
        
        $vendor = Vendor::create($data);

        return response()->json([
            'message' => 'Vendor created successfully',
            'vendor' => $vendor,
            'totalVendors' => Vendor::count()
        ]);
    }

    public function show(Vendor $vendor)
    {
        return response()->json($vendor);
    }

    public function update(Request $request, Vendor $vendor)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'items_supplied' => 'required|integer|min:0',
            'last_order' => 'required|date',
            'contact_info' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['status'] = $request->items_supplied > 10 ? 'Active' : 'Inactive';
        
        $vendor->update($data);

        return response()->json([
            'message' => 'Vendor updated successfully',
            'vendor' => $vendor
        ]);
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return response()->json([
            'message' => 'Vendor deleted successfully',
            'totalVendors' => Vendor::count()
        ]);
    }
}