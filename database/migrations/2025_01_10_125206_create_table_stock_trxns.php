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
        Schema::create('table_stock_trxns', function (Blueprint $table) {
            $table->string('id');
            $table->enum('trxn_type', ['sale', 'transfer', 'purchase', 'adjustment']);
            $table->integer('qtty');
            $table->integer('stock_before');
            $table->integer('stock_after');
            $table->string('reason');
            $table->string('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_stock_trxns');
    }
};
