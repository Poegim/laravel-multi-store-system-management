<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Store;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
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

        $faker = Faker::create('pl_PL');
        $shade = Arr::random(['200', '300', '400']);

        $stores = [
            [
                'name' => 'Bronowice Wyspa',
                'order' => rand(1,10),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->randomNumber(9),
                'city' => $faker->city(),
                'postcode' => $faker->randomNumber(5),
                'street' => $faker->streetName(),
                'building_number' => rand(1,200),
                'apartment_number' => rand(1,99),
                'color_id' => optional(
                    Color::inRandomOrder()
                        ->where('name', 'like', "%-$shade")
                        ->first()
                )->id,
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
                'description' => $faker->words(20, true),
            ],
            [
                'name' => 'Bronowice Sklep',
                'order' => rand(1,10),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->randomNumber(9),
                'city' => $faker->city(),
                'postcode' => $faker->randomNumber(5),
                'street' => $faker->streetName(),
                'building_number' => rand(1,200),
                'apartment_number' => rand(1,99),
                'color_id' => optional(
                    Color::inRandomOrder()
                        ->where('name', 'like', "%-$shade")
                        ->first()
                )->id,                'contracts_prefix' => 'BRS',
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
                'description' => $faker->words(20, true),
            ],
            [
                'name' => 'Galena Jaworzno',
                'order' => rand(1,10),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->randomNumber(9),
                'city' => $faker->city(),
                'postcode' => $faker->randomNumber(5),
                'street' => $faker->streetName(),
                'building_number' => rand(1,200),
                'apartment_number' => rand(1,99),
                'color_id' => optional(
                    Color::inRandomOrder()
                        ->where('name', 'like', "%-$shade")
                        ->first()
                )->id,                'contracts_prefix' => 'GJA',
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
                'description' => $faker->words(20, true),
            ],
            [
                'name' => 'iAkces Galeria Bronowice',
                'order' => rand(1,10),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->randomNumber(9),
                'city' => $faker->city(),
                'postcode' => $faker->randomNumber(5),
                'street' => $faker->streetName(),
                'building_number' => rand(1,200),
                'apartment_number' => rand(1,99),
                'color_id' => optional(
                    Color::inRandomOrder()
                        ->where('name', 'like', "%-$shade")
                        ->first()
                )->id,                'contracts_prefix' => 'IA',
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
                'description' => $faker->words(20, true),
            ],
            [
                'name' => 'Etuillo Bronowice Sklep',
                'order' => rand(1,10),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->randomNumber(9),
                'city' => $faker->city(),
                'postcode' => $faker->randomNumber(5),
                'street' => $faker->streetName(),
                'building_number' => rand(1,200),
                'apartment_number' => rand(1,99),
                'color_id' => optional(
                    Color::inRandomOrder()
                        ->where('name', 'like', "%-$shade")
                        ->first()
                )->id,                'contracts_prefix' => 'ET',
                'invoices_prefix' => 'ET',
                'margin_invoices_prefix' => 'ET',
                'proforma_invoices_prefix' => 'ET',
                'internal_servicing_prefix' => 'ET',
                'external_servicing_prefix' => 'ET',
                'next_receipt_number' => 1,
                'next_invoice_number' => 1,
                'next_margin_invoice_number' => 1,
                'next_proforma_invoice_number' => 1,
                'next_internal_servicing_number' => 1,
                'next_external_servicing_number' => 1,
                'description' => $faker->words(20, true),
            ],
        ];

        foreach ($stores as $store) {
            Store::create($store);
        }

    }
}
