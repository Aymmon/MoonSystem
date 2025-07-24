<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PosTransaction;
use App\Models\PosTransactionItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
class PosController extends Controller
{
    public function posList(Request $request)
    {
        $categoryId = $request->get('category');
        // Get all categories for the filter dropdown
        $categories = Category::all();
        // Get products filtered by category_id if provided, else get all
        $products = $categoryId
            ? Product::with('category')->where('category_id', $categoryId)->get()
            : Product::with('category')->get();

        $cart = session()->get('cart', []);
        return view('pos.pos', compact('products', 'categories', 'categoryId', 'cart'));
    }
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "picture" => $product->picture,
            ];
        }

        session()->put('cart', $cart);

        if ($request->ajax()) {
            $cart = session()->get('cart', []);
            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
            return response()->json([
                'cart' => $cart,
                'total' => number_format($total, 2)
            ]);
        }

        return redirect()->route('pos.list');
    }
    public function updateCart(Request $request)
    {
        $id = $request->input('id');
        $action = $request->input('action');

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($action === 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($action === 'decrease' && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            }
            session()->put('cart', $cart);
        }

        if ($request->ajax()) {
            $cart = session()->get('cart', []);
            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
            return response()->json([
                'cart' => $cart,
                'total' => number_format($total, 2)
            ]);
        }

        return back();
    }
    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        if ($request->ajax()) {
            $cart = session()->get('cart', []);
            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
            return response()->json([
                'cart' => $cart,
                'total' => number_format($total, 2)
            ]);
        }

        return redirect()->route('pos.list');
    }
    public function cartPartial()
    {
        $cart = session()->get('cart', []);
        return view('pos.partials.cart-sidebar', compact('cart'))->render();
    }

    public function checkout(Request $request)
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            if ($request->ajax()) {
                return response()->json(['message' => 'Cart is empty.'], 400);
            }
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        // Calculate total
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // Validate received amount
        $request->validate([
            'received_amount' => 'required|numeric|min:' . $total,
            'change_amount' => 'required|numeric',
        ]);

        // Generate transaction number (TRN-0000000001 format)
        $lastTransaction = PosTransaction::latest('id')->first();
        $lastNumber = 0;

        if ($lastTransaction && preg_match('/TRN-(\d+)/', $lastTransaction->transaction_number, $matches)) {
            $lastNumber = (int)$matches[1];
        }

        $newNumber = $lastNumber + 1;
        $transactionNumber = 'TRN-' . str_pad($newNumber, 10, '0', STR_PAD_LEFT);
        
        // Create transaction
        $transaction = PosTransaction::create([
            'transaction_number' => $transactionNumber,
            'total_amount' => $total,
            'received_amount' => $request->input('received_amount'),
            'change_amount' => $request->input('change_amount'),
            'transaction_date' => now(),
            'status' => 'completed',
        ]);

        // Create transaction items
        foreach ($cart as $productId => $item) {
            PosTransactionItem::create([
                'pos_transaction_id' => $transaction->id,
                'product_id' => $productId,
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        // Clear cart
        Session::forget('cart');

        if ($request->ajax()) {
            return response()->json(['message' => 'Checkout successful!']);
        }

        return redirect()->back()->with('success', 'Checkout successful!');
    }
}
