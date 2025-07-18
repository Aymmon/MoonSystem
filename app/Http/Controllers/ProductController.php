<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
class ProductController extends Controller
{
    public function productList()
    {
        $products = Product::all(); // Or use pagination: Product::paginate(10)
        return view('inventory.product', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $data = $request->all();

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('products', 'public');
            $data['picture'] = $path;
        }

        Product::create($data);

        return redirect()->route('product.list')->with('success', 'Product created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'picture' => 'nullable|image|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('picture')) {
            // Delete old image if exists
            if ($product->picture) {
                Storage::disk('public')->delete($product->picture);
            }
            $path = $request->file('picture')->store('products', 'public');
            $data['picture'] = $path;
        }

        $product->update($data);

        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

}
