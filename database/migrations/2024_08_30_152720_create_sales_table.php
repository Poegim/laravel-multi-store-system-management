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
            $table->integer('payment_method')->default(0); // 0 = cash, 1 = card, 2 = transfer
            $table->foreignId('contact_id')->nullable()->constrained()->onDelete('set null');
            $table->string('nip_number')->default('');
            $table->boolean('is_receipt_printed')->default(false);
            $table->timestamp('sold_at')->nullable();
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
