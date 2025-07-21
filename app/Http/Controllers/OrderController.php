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

        // Items sold today
        $soldItems = PosTransactionItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(subtotal) as total_sales'))
            ->whereHas('transaction', function ($q) use ($today) {
                $q->whereDate('transaction_date', $today);
            })
            ->groupBy('product_id')
            ->with('product')
            ->get();


        return view('order.order-list', compact('todaySalesTotal', 'soldItems'));
    }
}
