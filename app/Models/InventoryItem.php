<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'uom_id',
        'quantity',
        'low_stock_threshold',
    ];

    // Many-to-many with Product through ProductIngredient
    public function uom()
    {
        return $this->belongsTo(Uom::class, 'uom_id');
    }
}
