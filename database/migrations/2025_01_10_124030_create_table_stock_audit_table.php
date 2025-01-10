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
        Schema::create('stock_audit', function (Blueprint $table) {
            $table->string('id');
            $table->foreignUlid('product_id')->constrained()->onDelete('cascade');
            $table->integer('physical_qtty');
            $table->integer('spoilage');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_stock_audit');
    }
};
