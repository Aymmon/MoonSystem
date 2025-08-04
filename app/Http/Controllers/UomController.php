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
            'name' => 'required|string|max:255',
            'abbreviation' => 'required|string|max:10',
        ]);

        Uom::create($request->only('name', 'abbreviation'));

        return redirect()->route('oums.list')->with('success', 'UOM added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'abbreviation' => 'required|string|max:10',
        ]);

        $uom = Uom::findOrFail($id);
        $uom->update($request->only('name', 'abbreviation'));

        return redirect()->route('oums.list')->with('success', 'UOM updated successfully.');
    }

    public function destroy($id)
    {
        $uom = Uom::findOrFail($id);
        $uom->delete();

        return redirect()->route('oums.list')->with('success', 'UOM deleted successfully.');
    }
}
