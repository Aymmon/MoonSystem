<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Uom;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('product', 'uom')->get();
        $products = Product::all();
        $uoms = Uom::all();

        return view('inventory.inventory',compact('inventories', 'products', 'uoms'));
    }

      public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'uom_id' => 'nullable|exists:uoms,id',
            'quantity' => 'required|integer|min:0',
        ]);

        Inventory::create($validated);

        return redirect()->route('inventories.list')->with('success', 'Inventory created successfully.');
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'uom_id' => 'nullable|exists:uoms,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $inventory->update($validated);

        return redirect()->route('inventories.list')->with('success', 'Inventory updated successfully.');
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('inventories.list')->with('success', 'Inventory deleted successfully.');
    }
}
