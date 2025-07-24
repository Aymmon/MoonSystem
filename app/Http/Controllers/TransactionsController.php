<?php
namespace App\Http\Controllers;
use App\Models\PosTransaction;
use Illuminate\Support\Facades\DB;
class TransactionsController extends Controller
{
    public function transactionsList()
    {
        // All transactions (no date filter)
        $allTransactions = PosTransaction::with('items.product')->get();

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
        return view('transactions.transactions-list', compact('todaySalesTotal','totalQuantitySold', 'transactions','topSelling','allTransactions'));
    }

    public function show($id)
    {
        $transaction = PosTransaction::with('items.product')->findOrFail($id);
        return view('transactions.partials.receipt', compact('transaction'))->render();
    }

    public function cancel($id)
    {
        $transaction = PosTransaction::findOrFail($id);
        $transaction->status = 'cancelled';
        $transaction->save();

        return redirect()->back()->with('success', 'Transaction cancelled successfully.');
    }
}
