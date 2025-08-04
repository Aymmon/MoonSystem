<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UomConversion extends Model
{
    protected $fillable = [
        'from_unit',
        'to_unit',
        'conversion_factor',
    ];
}
