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
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained();
            $table->foreignId('vat_rate_id')->constrained();
            $table->foreignId('external_invoice_id')->constrained();
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('color_id')->constrained();
            $table->integer('suggested_retail_price')->nullable();
            $table->integer('purchase_price_net')->nullable();
            $table->integer('purchase_price_gross')->nullable();
            $table->foreignId('sale_id')->nullable()->constrained();
            $table->integer('sold_price')->nullable();
            $table->integer('status')->default(0);
            $table->foreignId('store_id');
            $table->string('imei_number')->nullable();
            $table->string('serial_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_items');
    }
};
