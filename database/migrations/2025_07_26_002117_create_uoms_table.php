<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('uoms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "Kilogram"
            $table->string('symbol'); // e.g. "kg"
            $table->unsignedInteger('base_conversion');
            $table->string('base_unit'); // e.g. "g" (gram)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uoms');
    }
};
