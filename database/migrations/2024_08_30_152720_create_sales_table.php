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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('status')->default(0); // 0 = pending, 1 = completed, 2 = cancelled, see app/Models/Commerce/Sale.php
            $table->integer('document_type')->default(0); // receipt, receipt_nip, invoice, see app/Models/Commerce/Sale.php
            $table->foreignId('contact_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('nip_number')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
