<?php

namespace Database\Seeders;

use App\Models\Commerce\ExternalInvoice;
use App\Models\Contact;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExternalInvoicesTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        // Pobranie wszystkich kontaktów raz
        $contacts = Contact::companies()->pluck('id')->toArray();

        $totalCompleted = 200; // liczba completed invoices
        $totalTemporary = 10;    // liczba temporary invoices
        $batchSize = 1000;       // wielkość batcha
        $batchData = [];
        $inserted = 0;

        // --- Completed invoices ---
        for ($i = 0; $i < $totalCompleted; $i++) {
            $batchData[] = [
                'invoice_number' => 'INV-' . date('Y') . '-' . str_pad($i + 1, 6, '0', STR_PAD_LEFT),
                'store_id' => rand(1,5),
                'user_id' => rand(1,5),
                'contact_id' => $faker->randomElement($contacts),
                'is_temp' => ExternalInvoice::COMPLETED,
                'created_at' => $faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s'),
                'updated_at' => now(),
            ];

            // Masowy insert co batchSize
            if (count($batchData) >= $batchSize) {
                DB::table('external_invoices')->insert($batchData);
                $inserted += count($batchData);
                echo "✅ Inserted {$inserted} completed invoices...\n";
                $batchData = [];
            }
        }

        // Wstawienie pozostałych rekordów, jeśli są
        if (!empty($batchData)) {
            DB::table('external_invoices')->insert($batchData);
            $inserted += count($batchData);
            echo "✅ Inserted {$inserted} completed invoices...\n";
            $batchData = [];
        }

        // --- Temporary invoices ---
        for ($i = 0; $i < $totalTemporary; $i++) {
            $batchData[] = [
                'invoice_number' => 'INV-' . date('Y') . '-T' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'store_id' => rand(1,5),
                'user_id' => rand(1,5),
                'contact_id' => $faker->randomElement($contacts),
                'is_temp' => ExternalInvoice::TEMPORARY,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($batchData) >= $batchSize) {
                DB::table('external_invoices')->insert($batchData);
                $inserted += count($batchData);
                echo "✅ Inserted {$inserted} invoices (including temporary)...\n";
                $batchData = [];
            }
        }

        if (!empty($batchData)) {
            DB::table('external_invoices')->insert($batchData);
            $inserted += count($batchData);
            echo "✅ Inserted {$inserted} invoices (including temporary)...\n";
        }

        echo "🎉 Seeder completed. Total invoices inserted: {$inserted}\n";
    }
}
