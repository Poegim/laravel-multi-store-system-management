<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use App\Models\Contact;
use App\Models\Commerce\Sale;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Warehouse\StockItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $contacts = Contact::pluck('id')->toArray();
        $stores = Store::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();

        $batchSize = 100; // number of records per insert
        $totalRecords = 10000; // total records to generate
        $batchData = [];

        $insertedCount = 0;

        for ($i = 0; $i < $totalRecords; $i++) {
            $paymentMethod = rand(0, 2); // 0 = cash, 1 = card, 2 = transfer
            $documentType = rand(0, 2);  // 0 = receipt, 1 = receipt_nip, 2 = invoice
            $date = $faker->dateTimeBetween('-9 years', 'now')->format('Y-m-d H:i:s');

            $batchData[] = [
                'store_id' => $stores[array_rand($stores)],
                'user_id' => $users[array_rand($users)],
                'status' => 1, // completed
                'document_type' => $documentType,
                'payment_method' => $paymentMethod,
                'contact_id' => $documentType === 2 ? $contacts[array_rand($contacts)] : null, // only for invoices
                'nip_number' => $documentType === 1 ? $faker->numerify('###-###-##-##') : '',
                'is_receipt_printed' => false,
                'sold_at' => $date,
                'created_at' => $date,
                'updated_at' => now(),
            ];

            // When batch reaches 100 records, insert and clear array
            if (count($batchData) === $batchSize) {
                DB::table('sales')->insert($batchData);
                $insertedCount += $batchSize;

                // Console output for progress
                $this->command->info("Inserted {$insertedCount} records...");

                // Clear batch data
                $batchData = [];
            }
        }

        // Insert remaining records (if any)
        if (!empty($batchData)) {
            DB::table('sales')->insert($batchData);
            $insertedCount += count($batchData);
            $this->command->info("Inserted remaining " . count($batchData) . " records. Total: {$insertedCount}");
        }

        // Final message
        $this->command->info("✅ Seeding completed. Total inserted: {$insertedCount} records.");

        Sale::chunk(1000, function ($sales) use ($faker) {
        $allStockItems = StockItem::available()->get()->shuffle();
        $pivotBatch = [];
        $counter = 0;

        foreach ($sales as $sale) {
            $itemsCount = $this->getWeightedRandomNumber();
            $selectedItems = $allStockItems->random($itemsCount);

            foreach ($selectedItems as $stockItem) {
                $pivotBatch[] = [
                    'sale_id' => $sale->id,
                    'stock_item_id' => $stockItem->id,
                    'price' => max($stockItem->suggested_retail_price, 1),
                    'sold_at' => $sale->sold_at,
                    'vat_rate' => 23,
                    'created_at' => $sale->sold_at,
                    'updated_at' => now(),
                ];

                $counter++;

                if ($counter % 1000 === 0) {
                    DB::table('sale_stock_item')->insert($pivotBatch);
                    $pivotBatch = [];
                    echo "Inserted {$counter} pivot records...\n";
                }
            }
        }

        if (!empty($pivotBatch)) {
            DB::table('sale_stock_item')->insert($pivotBatch);
        }
        echo "✅ Finished attaching all stock items! Total processed: {$counter}\n";
        Log::info("✅ Finished attaching all stock items! Total processed: {$counter}");
        
    });

    }

    private function getWeightedRandomNumber(): int {
        // Generate a random float between 0 and 1
        $rand = mt_rand() / mt_getrandmax();

        // If the random number is within 70% probability
        if ($rand < 0.70) {
            // Choose a random number between 1 and 2
            return mt_rand(1, 2);
        }
        // If the random number is within the next 25% probability
        elseif ($rand < 0.95) {
            // Choose a random number between 3 and 4
            return mt_rand(3, 4);
        }
        // Remaining 5% probability
        else {
            // Choose a random number between 5 and 8
            return mt_rand(5, 8);
       }
    }


}
