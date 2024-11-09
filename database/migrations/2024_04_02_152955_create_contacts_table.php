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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname')->default('');
            $table->string('identification_number')->unique();
            $table->boolean('type');
            $table->string('country')->default('Polska');
            $table->string('city');
            $table->string('postcode');
            $table->string('street');
            $table->string('building_number');
            $table->string('apartment_number')->default('');
            $table->string('email')->default('');
            $table->string('phone')->default('');
            $table->string('second_phone')->default('');
            $table->string('www')->default('');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
