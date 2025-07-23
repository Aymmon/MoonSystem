<?php

namespace App\Http\Controllers;

use App\Models\PosTransaction;
use App\Models\PosTransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orderList()
    {
        $today = today();

        // Today's total sales
        $todaySalesTotal = PosTransaction::whereDate('transaction_date', $today)
            ->sum('total_amount');

        // Total quantity sold today
        $totalQuantitySold = \DB::table('pos_transaction_items')
            ->join('pos_transactions', 'pos_transaction_items.pos_transaction_id', '=', 'pos_transactions.id')
            ->whereDate('pos_transactions.transaction_date', $today)
            ->sum('pos_transaction_items.quantity');

        // Transactions made today (1 row per transaction)
        $transactions = PosTransaction::with('items.product')
            ->whereDate('transaction_date', $today)
            ->get();

        // Highest selling product(s) by quantity
        $topSelling = \DB::table('pos_transaction_items')
            ->join('pos_transactions', 'pos_transaction_items.pos_transaction_id', '=', 'pos_transactions.id')
            ->join('products', 'pos_transaction_items.product_id', '=', 'products.id')
            ->whereDate('pos_transactions.transaction_date', $today)
            ->select('product_id', 'products.name as product_name', \DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id', 'products.name')
            ->orderByDesc('total_quantity')
            ->first();
        return view('order.order-list', compact('todaySalesTotal','totalQuantitySold', 'transactions','topSelling'));
    }

}
