<?php

namespace App\Http\Controllers;

use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'size'       => 'required|string|max:50',
            'price'      => 'required|numeric|min:0',
        ]);

        ProductSize::create($validated);

        return response()->json(['message' => 'Product size added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $productSize = ProductSize::findOrFail($id);

        $validated = $request->validate([
            'size'  => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
        ]);

        $productSize->update($validated);

        return response()->json(['message' => 'Product size updated successfully.']);
    }

    public function destroy($id)
    {
        $productSize = ProductSize::findOrFail($id);
        $productSize->delete();

        return response()->json(['message' => 'Product size deleted successfully.']);
    }
}
