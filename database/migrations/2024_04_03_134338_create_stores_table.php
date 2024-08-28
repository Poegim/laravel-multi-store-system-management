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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('order');
            $table->string('email');
            $table->string('phone');
            $table->string('city')->default('');
            $table->integer('postcode');
            $table->string('street')->nullable();
            $table->string('building_number')->nullable();
            $table->string('apartment_number')->nullable();
            $table->foreignId('color_id')->constrained('colors');
            $table->string('contracts_prefix')->unique();
            $table->string('invoices_prefix')->unique();
            $table->string('margin_invoices_prefix')->unique();
            $table->string('proforma_invoices_prefix')->unique();
            $table->string('internal_servicing_prefix')->unique();
            $table->string('external_servicing_prefix')->unique();
            $table->integer('next_receipt_number');
            $table->integer('next_invoice_number');
            $table->integer('next_margin_invoice_number');
            $table->integer('next_proforma_invoice_number');
            $table->integer('next_internal_servicing_number');
            $table->integer('next_external_servicing_number');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
