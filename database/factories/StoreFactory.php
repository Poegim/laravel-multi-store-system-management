<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prefix = strtoupper(Str::random(rand(3,3)));

        return [
            'name' => fake()->company(),
            'order' => rand(1,10),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->randomNumber(9),
            'city' => fake()->city(),
            'postcode' => fake()->randomNumber(5),
            'street' => fake()->streetName(),
            'building_number' => rand(1,200),
            'apartment_number' => rand(1,99),
            'color_id' => Color::inRandomOrder()->first(),
            'contracts_prefix' => $prefix,
            'invoices_prefix' => $prefix,
            'margin_invoices_prefix' => $prefix,
            'proforma_invoices_prefix' => $prefix,
            'internal_servicing_prefix' => $prefix,
            'external_servicing_prefix' => $prefix,
            'next_receipt_number' => rand(1,100000),
            'next_invoice_number' => rand(1,10000),
            'next_margin_invoice_number' => rand(1,5000),
            'next_proforma_invoice_number' => rand(1,99),
            'next_internal_servicing_number' => rand(1,1000),
            'next_external_servicing_number' => rand(1,1000),
            'description' => fake()->words(20, true),
        ];
    }
}
