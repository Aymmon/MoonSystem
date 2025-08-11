<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\ProductSize;
use App\Models\Uom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function productList()
    {
        $uoms = Uom::all();
        $products = Product::with('category')->get(); // eager load category
        $categories = Category::all();
        return view('inventory.product', compact('products', 'categories', 'uoms'));
    }

    public function productAdd()
    {

        $uoms = Uom::all();
        $products = Product::with('category')->get(); // eager load category
        $categories = Category::all();
        return view('inventory.add-product', compact('products', 'categories', 'uoms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'nullable|numeric|min:0', // price is now optional if sizes are used
            'picture' => 'nullable|image|max:2048',
            'sizes.*.size' => 'nullable|string|max:50',
            'sizes.*.price' => 'nullable|numeric|min:0',
        ]);

        $data = $request->only(['name', 'description', 'price', 'category_id']);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('products', 'public');
        }

        $product = Product::create($data);

        // Save sizes if available
        if ($request->has('sizes')) {
            foreach ($request->sizes as $size) {
                if (!empty($size['size']) && !empty($size['price'])) {
                    ProductSize::create([
                        'product_id' => $product->id,
                        'size' => $size['size'],
                        'price' => $size['price'],
                    ]);
                }
            }
        }

        return redirect()->route('product.list')->with('success', 'Product created with sizes.');
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $data = $request->only(['name', 'description', 'price', 'category_id']);

        if ($request->hasFile('picture')) {
            if ($product->picture) {
                Storage::disk('public')->delete($product->picture);
            }
            $data['picture'] = $request->file('picture')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->picture) {
            Storage::disk('public')->delete($product->picture);
        }
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    public function reduceInventory($productId, $quantityOrdered = 1)
    {
        $product = Product::with('ingredients.inventory', 'ingredients.uom')->findOrFail($productId);

        foreach ($product->ingredients as $ingredient) {
            $inventory = $ingredient->inventory;

            if ($inventory->uom_id !== $ingredient->uom_id) {
                // Add conversion logic here if needed
            }

            $totalUsed = $ingredient->quantity * $quantityOrdered;

            if ($inventory->quantity < $totalUsed) {
                return response()->json([
                    'error' => "Not enough {$inventory->name} in stock"
                ], 400);
            }

            $inventory->quantity -= $totalUsed;
            $inventory->save();
        }

        return response()->json(['message' => 'Inventory updated successfully']);
    }

}
