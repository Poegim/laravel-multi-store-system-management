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
            $table->string('name');
            $table->integer('orded');
            $table->string('email');
            $table->integer('phone');
            $table->string('city');
            $table->integer('postcode');
            $table->string('street');
            $table->string('building_number');
            $table->string('apartment_number');
            $table->string('color');
            $table->string('contracts_prefix');
            $table->string('invoices_prefix');
            $table->string('margin_invoices_prefix');
            $table->string('proforma_invoices_prefix');
            $table->string('internal_services_prefix');
            $table->string('external_services_prefix');
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
