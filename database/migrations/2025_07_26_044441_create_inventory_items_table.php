<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemsTable extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('uom_id')->nullable(); // Correct type
            $table->decimal('quantity', 10, 2)->default(0);
            $table->text('description')->nullable();
            $table->timestamps();

            // Define foreign key correctly
            $table->foreign('uom_id')->references('id')->on('uoms')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
}
