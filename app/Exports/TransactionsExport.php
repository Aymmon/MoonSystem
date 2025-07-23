<?php

namespace App\Exports;

use App\Models\PosTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return PosTransaction::with('items.product')->get()->map(function ($transaction) {
            return [
                'Transaction #' => $transaction->transaction_number,
                'Total Amount' => $transaction->total_amount,
                'Status' => $transaction->status,
                'Transaction Date' => \Carbon\Carbon::parse($transaction->transaction_date)->format('m-d-Y'),
                'Transaction Time' => \Carbon\Carbon::parse($transaction->transaction_date)->format('h:i A'),
                'Items' => $transaction->items->map(fn($item) => ($item->product->name ?? 'N/A') . ' x' . $item->quantity)->implode(', ')
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Transaction #',
            'Total Amount',
            'Status',
            'Transaction Date',
            'Transaction Time',
            'Items'
        ];
    }
}
