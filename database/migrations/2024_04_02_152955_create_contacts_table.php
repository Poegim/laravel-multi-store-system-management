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
            $table->string('identification_number')->unique()->nullable();
            $table->boolean('type');
            $table->string('country')->default('Polska')->nullable();
            $table->string('city')->default('')->nullable();
            $table->string('postcode')->default('')->nullable();
            $table->string('street')->default('')->nullable();;
            $table->string('building_number')->default('')->nullable();;
            $table->string('apartment_number')->default('')->nullable();
            $table->string('email')->default('')->default('')->nullable();
            $table->string('phone')->default('')->default('')->nullable();
            $table->string('second_phone')->default('')->nullable();
            $table->string('www')->default('')->default('')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained();
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
