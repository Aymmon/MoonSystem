<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    protected $fillable = ['name', 'abbreviation'];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
