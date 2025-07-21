<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
        public function posList(Request $request)
    {
        $category = $request->get('category');
        $categories = Product::distinct()->pluck('category');
        $products = $category
            ? Product::where('category', $category)->get()
            : Product::all();
        $cart = session()->get('cart', []);

        return view('pos.pos', compact('products', 'categories', 'category', 'cart'));
    }
    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "picture" => $product->picture
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('pos.list');
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart');
        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('pos.list');
    }
}
