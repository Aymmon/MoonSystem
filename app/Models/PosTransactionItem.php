<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PosTransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'pos_transaction_id',
        'product_id',
        'price',
        'quantity',
        'subtotal',
    ];

    public function transaction()
    {
        return $this->belongsTo(PosTransaction::class, 'pos_transaction_id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class); // Make sure your product model is named correctly
    }
}
