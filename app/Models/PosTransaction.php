<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PosTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_number',
        'total_amount',
        'transaction_date',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(PosTransactionItem::class);
    }
}
