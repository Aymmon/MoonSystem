<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'inventory_item_id',
        'quantity',
        'unit',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class);
    }
}
