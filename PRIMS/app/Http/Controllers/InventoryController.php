<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Supply;

class InventoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'brand' => 'nullable|string',
            'category' => 'required|string',
            'unit' => 'required|string',
            'quantity_received' => 'required|integer|min:1',
            'date_supplied' => 'required|date',
            'expiration_date' => 'nullable|date|after_or_equal:date_supplied',
        ]);

        // Check if the supply already exists
        $supply = Supply::firstOrCreate(
            [
                'name' => $request->name,
                'brand' => $request->brand,
                'category' => $request->category,
                'unit' => $request->unit,
            ]
        );

        $clinicStaff = auth()->user()->clinicStaff;


        // Insert into inventory
        Inventory::create([
            'supply_id' => $supply->id,
            'quantity_received' => $request->quantity_received,
            'date_supplied' => $request->date_supplied,
            'expiration_date' => $request->expiration_date,
            'updated_by' => $clinicStaff->id, // Ensure user is logged in
        ]);

        return redirect()->route('medical-inventory')->with('success', 'Medicine added successfully!');
        
    }
}

