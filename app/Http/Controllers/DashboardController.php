<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PosTransaction;
use App\Models\PosTransactionItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
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


        return view('dashboard', compact('todaySalesTotal', 'soldItems'));
    }
}
