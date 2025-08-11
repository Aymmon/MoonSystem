<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    protected $table = 'uoms';

    protected $fillable = [
        'name',
        'symbol',
        'base_conversion',
        'base_unit',
    ];
}
