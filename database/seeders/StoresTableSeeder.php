<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Store::factory(5)->create();

        $stores = [
            [
                'name' => 'Bronowice Wyspa',
                'order' => rand(1,10),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->randomNumber(9),
                'city' => fake()->city(),
                'postcode' => fake()->randomNumber(5),
                'street' => fake()->streetName(),
                'building_number' => rand(1,200),
                'apartment_number' => rand(1,99),
                'color_id' => Color::inRandomOrder()->first()->id,
                'contracts_prefix' => 'BRW',
                'invoices_prefix' => 'BRW',
                'margin_invoices_prefix' => 'BRW',
                'proforma_invoices_prefix' => 'BRW',
                'internal_servicing_prefix' => 'BRW',
                'external_servicing_prefix' => 'BRW',
                'next_receipt_number' => 1,
                'next_invoice_number' => 1,
                'next_margin_invoice_number' => 1,
                'next_proforma_invoice_number' => 1,
                'next_internal_servicing_number' => 1,
                'next_external_servicing_number' => 1,
                'description' => fake()->words(20, true),
            ],
            [
                'name' => 'Bronowice Sklep',
                'order' => rand(1,10),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->randomNumber(9),
                'city' => fake()->city(),
                'postcode' => fake()->randomNumber(5),
                'street' => fake()->streetName(),
                'building_number' => rand(1,200),
                'apartment_number' => rand(1,99),
                'color_id' => Color::inRandomOrder()->first()->id,
                'contracts_prefix' => 'BRS',
                'invoices_prefix' => 'BRS',
                'margin_invoices_prefix' => 'BRS',
                'proforma_invoices_prefix' => 'BRS',
                'internal_servicing_prefix' => 'BRS',
                'external_servicing_prefix' => 'BRS',
                'next_receipt_number' => 1,
                'next_invoice_number' => 1,
                'next_margin_invoice_number' => 1,
                'next_proforma_invoice_number' => 1,
                'next_internal_servicing_number' => 1,
                'next_external_servicing_number' => 1,
                'description' => fake()->words(20, true),
            ],
            [
                'name' => 'Galena Jaworzno',
                'order' => rand(1,10),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->randomNumber(9),
                'city' => fake()->city(),
                'postcode' => fake()->randomNumber(5),
                'street' => fake()->streetName(),
                'building_number' => rand(1,200),
                'apartment_number' => rand(1,99),
                'color_id' => Color::inRandomOrder()->first()->id,
                'contracts_prefix' => 'GJA',
                'invoices_prefix' => 'GJA',
                'margin_invoices_prefix' => 'GJA',
                'proforma_invoices_prefix' => 'GJA',
                'internal_servicing_prefix' => 'GJA',
                'external_servicing_prefix' => 'GJA',
                'next_receipt_number' => 1,
                'next_invoice_number' => 1,
                'next_margin_invoice_number' => 1,
                'next_proforma_invoice_number' => 1,
                'next_internal_servicing_number' => 1,
                'next_external_servicing_number' => 1,
                'description' => fake()->words(20, true),
            ],
            [
                'name' => 'iAkces Galeria Bronowice',
                'order' => rand(1,10),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->randomNumber(9),
                'city' => fake()->city(),
                'postcode' => fake()->randomNumber(5),
                'street' => fake()->streetName(),
                'building_number' => rand(1,200),
                'apartment_number' => rand(1,99),
                'color_id' => Color::inRandomOrder()->first()->id,
                'contracts_prefix' => 'IA',
                'invoices_prefix' => 'IA',
                'margin_invoices_prefix' => 'IA',
                'proforma_invoices_prefix' => 'IA',
                'internal_servicing_prefix' => 'IA',
                'external_servicing_prefix' => 'IA',
                'next_receipt_number' => 1,
                'next_invoice_number' => 1,
                'next_margin_invoice_number' => 1,
                'next_proforma_invoice_number' => 1,
                'next_internal_servicing_number' => 1,
                'next_external_servicing_number' => 1,
                'description' => fake()->words(20, true),
            ],
            [
                'name' => 'MyCase Galeria Bronowice',
                'order' => rand(1,10),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->randomNumber(9),
                'city' => fake()->city(),
                'postcode' => fake()->randomNumber(5),
                'street' => fake()->streetName(),
                'building_number' => rand(1,200),
                'apartment_number' => rand(1,99),
                'color_id' => Color::inRandomOrder()->first()->id,
                'contracts_prefix' => 'MCGB',
                'invoices_prefix' => 'MCGB',
                'margin_invoices_prefix' => 'MCGB',
                'proforma_invoices_prefix' => 'MCGB',
                'internal_servicing_prefix' => 'MCGB',
                'external_servicing_prefix' => 'MCGB',
                'next_receipt_number' => 1,
                'next_invoice_number' => 1,
                'next_margin_invoice_number' => 1,
                'next_proforma_invoice_number' => 1,
                'next_internal_servicing_number' => 1,
                'next_external_servicing_number' => 1,
                'description' => fake()->words(20, true),
            ],
        ];

        foreach ($stores as $store) {
            Store::create($store);
        }

    }
}
