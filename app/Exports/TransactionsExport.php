<?php

namespace App\Exports;

use App\Models\PosTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class TransactionsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return PosTransaction::with('items.product')->get()->map(function ($transaction) {
            return [
                'Transaction #' => $transaction->transaction_number,
                'Total Amount' => '₱' . number_format($transaction->total_amount, 2),
                'Received Amount' => '₱' . number_format($transaction->received_amount, 2),
                'Change Amount' => '₱' . number_format($transaction->change_amount, 2),
                'Status' => ucfirst($transaction->status),
                'Transaction Date' => \Carbon\Carbon::parse($transaction->transaction_date)->format('F d, Y'),
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
            'Received Amount',
            'Change Amount',
            'Status',
            'Transaction Date',
            'Transaction Time',
            'Items'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $cellRange = "A1:{$highestColumn}{$highestRow}";

        // Apply border and alignment to all cells
        $sheet->getStyle($cellRange)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        // Style heading row
        $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFFCC00'], // Yellow background
            ],
        ]);

        return [];
    }
}
