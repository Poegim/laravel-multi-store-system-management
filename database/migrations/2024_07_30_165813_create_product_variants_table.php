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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('default');
            $table->string('slug')->default('');
            $table->integer('suggested_retail_price')->default(0);
            $table->string('ean')->nullable();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('user_id')->constrained();
            $table->unique(['slug', 'product_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
