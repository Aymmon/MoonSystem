<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
        public function posList()
    {
        $pos = Product::all(); // Or use pagination: Product::paginate(10)
        return view('pos.pos', compact('pos'));
    }
}
