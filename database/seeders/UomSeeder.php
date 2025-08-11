<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Uom;
class UomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Uom::insert([
            ['name' => 'Kilogram', 'symbol' => 'kg', 'base_conversion' => 1000, 'base_unit' => 'g'],
            ['name' => 'Gram', 'symbol' => 'g', 'base_conversion' => 1, 'base_unit' => 'g'],
            ['name' => 'Liter', 'symbol' => 'L', 'base_conversion' => 1000, 'base_unit' => 'ml'],
            ['name' => 'Milliliter', 'symbol' => 'ml', 'base_conversion' => 1, 'base_unit' => 'ml'],
            ['name' => 'Piece', 'symbol' => 'pc', 'base_conversion' => 1, 'base_unit' => 'pc'],
        ]);
    }
}
