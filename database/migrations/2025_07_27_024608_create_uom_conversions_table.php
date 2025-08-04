<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('uom_conversions', function (Blueprint $table) {
            $table->id();
            $table->string('from_unit'); // e.g. tbsp
            $table->string('to_unit');   // e.g. kilo
            $table->decimal('conversion_factor', 10, 6); // e.g. 0.015
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uom_conversions');
    }
};
