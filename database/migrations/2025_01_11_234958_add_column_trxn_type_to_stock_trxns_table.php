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
        Schema::table('stock_trxns', function (Blueprint $table) {
            //
            $table->dropColumn('trxn_type');
            $table->enum('trxn_type', ['sale', 'audit', 'transfer', 'purchase', 'adjustment', 'opening_stock']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_trxns', function (Blueprint $table) {
            //
        });
    }
};
