<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\Uom;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    public function index()
    {
        $items = InventoryItem::with('uom')->get();
        $uoms = Uom::all();
        return view('inventory.inventory', compact('items','uoms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'uom_id' => 'required|exists:uoms,id',
            'quantity' => 'required|numeric|min:0',
            'low_stock_threshold' => 'nullable|numeric|min:0',
        ]);

        InventoryItem::create($validated);
        return redirect()->route('inventory.index')->with('success', 'Inventory item added successfully.');
    }

    public function update(Request $request, InventoryItem $inventory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'uom_id' => 'required|exists:uoms,id',
            'quantity' => 'required|numeric|min:0',
            'low_stock_threshold' => 'nullable|numeric|min:0',
        ]);

        $inventory->update($validated);
        return redirect()->route('inventory.index')->with('success', 'Inventory item updated successfully.');
    }

    public function destroy(InventoryItem $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventory.index')->with('success', 'Inventory item deleted successfully.');
    }
}
