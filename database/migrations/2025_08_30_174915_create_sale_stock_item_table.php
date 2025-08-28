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
        Schema::create('sale_stock_item', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->foreignId('sale_id')->constrained()->onDelete('cascade');
            $table->foreignId('stock_item_id')->constrained()->onDelete('cascade');
            $table->timestamp('sold_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_stock_item');
    }
};
