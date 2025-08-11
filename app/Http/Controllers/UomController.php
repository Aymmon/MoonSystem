<?php

namespace App\Http\Controllers;

use App\Models\Uom;
use Illuminate\Http\Request;

class UomController extends Controller
{
    public function index()
    {
        $uoms = Uom::all();
        return view('inventory.uom', compact('uoms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'symbol' => 'required|string|max:10',
            'base_unit' => 'required|string',
            'base_conversion' => 'required|numeric|min:0',
        ]);

        Uom::create($request->all());

        return back()->with('success', 'UOM created successfully.');
    }

    public function edit($id)
    {
        return Uom::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $uom = Uom::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'symbol' => 'required|string|max:10',
            'base_unit' => 'required|string',
            'base_conversion' => 'required|numeric|min:0',
        ]);

        $uom->update($request->all());

        return back()->with('success', 'UOM updated successfully.');
    }

    public function destroy($id)
    {
        Uom::findOrFail($id)->delete();
        return back()->with('success', 'UOM deleted successfully.');
    }
}
