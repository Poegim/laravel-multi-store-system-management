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
        Schema::create('external_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('store_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('company_id')->constrained();
            $table->integer('price');
            $table->boolean('is_temp')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_invoices');
    }
};
