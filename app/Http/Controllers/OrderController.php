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

        // Transactions made today (1 row per transaction)
        $transactions = PosTransaction::with('items.product')
            ->whereDate('transaction_date', $today)
            ->get();

        return view('order.order-list', compact('todaySalesTotal', 'transactions'));
    }

}
