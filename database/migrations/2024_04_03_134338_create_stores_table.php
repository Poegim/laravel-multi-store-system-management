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
            $table->integer('phone');
            $table->string('city');
            $table->integer('postcode');
            $table->string('street');
            $table->string('building_number');
            $table->string('apartment_number');
            $table->string('color')->unique();
            $table->string('contracts_prefix')->unique();
            $table->string('invoices_prefix')->unique();
            $table->string('margin_invoices_prefix')->unique();
            $table->string('proforma_invoices_prefix')->unique();
            $table->string('internal_services_prefix')->unique();
            $table->string('external_services_prefix')->unique();
            $table->integer('next_receipt_number');
            $table->integer('next_invoice_number');
            $table->integer('next_margin_invoice_number');
            $table->integer('next_proforma_invoice_number');
            $table->integer('next_internal_service_number');
            $table->integer('next_external_service_number');
            $table->longText('description');
            $table->timestamps();
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
