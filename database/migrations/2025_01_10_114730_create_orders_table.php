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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('customer_id');
            $table->decimal('total', 10, 2);
            $table->string("cashier");
            $table->enum('status', ['unpaid', 'paid', 'partially_paid', 'cancelled'])->default('unpaid'); // Payment status
            $table->enum('dine', ['DELIVERY', 'DINE_IN', 'TAKE_AWAY']);
            $table->enum('payment', ['MPESA', 'CASH', 'CREDIT']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
