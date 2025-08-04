<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "Sugar", "Plastic Cup"
            $table->decimal('quantity', 10, 2); // e.g. 25.00
            $table->unsignedBigInteger('uom_id'); // e.g. kg, pc
            $table->timestamps();
            $table->foreign('uom_id')->references('id')->on('uoms')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
