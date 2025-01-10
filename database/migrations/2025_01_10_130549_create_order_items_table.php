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
        Schema::create('order_items', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignUlid('order_id')->constrained()->onDelete('cascade'); // Link to Orders Table
            $table->foreignUlid('product_id')->constrained()->onDelete('cascade'); // Link to Products Table
            $table->string('product_name'); // Snapshot of Product Name
            $table->decimal('price', 10, 2); // Price per Item
            $table->integer('quantity'); // Quantity Ordered
            $table->decimal('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
