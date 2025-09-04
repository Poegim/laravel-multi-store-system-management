<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Commerce\ExternalInvoice;
use App\Models\Store;
use App\Models\VatRate;
use App\Models\Warehouse\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Warehouse\ProductVariant;
use App\Traits\GetRandomPrice;
use App\Traits\NetToGrossConverts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StockItemsTableSeeder extends Seeder
{

    use GetRandomPrice;
    use NetToGrossConverts;

    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     $numberOfSeeds = 10000;
    //     $externalInvoicesCount = ExternalInvoice::count();

    //     // Array of 30 random colors
    //     $colors = Color::all()->pluck('id')->toArray();

    //     // Fetch all product variants to randomly assign to stock items
    //     $productVariants = ProductVariant::all()->pluck('id')->toArray();
    //     $stores = Store::all()->pluck('id')->toArray();
    //     $brands = Brand::all()->pluck('id')->toArray();

    //     $batchSize = 1000; // Define batch size
    //     $totalInserted = 0; // Counter to track total inserted records
    //     $batchData = [];
    //     $vatRate = VatRate::getDefault()->id;

    //     for ($i = 0; $i < $numberOfSeeds; $i++) { // Adjust loop for desired number of stock items
    //         // Randomly select a color, store and product_variant_id
    //         $color = $colors[array_rand($colors)];
    //         $productVariantId = $productVariants[array_rand($productVariants)];
    //         $storeId = $stores[array_rand($stores)];
    //         $brandId = $brands[array_rand($brands)];
    //         $price = rand(1,5) === 1 ? 0 : $this->getRandomPrice();
    //         $randomNetPrice = rand(100, 5000); // Random net price between 100 and 5000

    //         while (($randomNetPrice > $price) && ($price > 0)) {
    //             $randomNetPrice = rand(100, 5000); // Ensure net price is not greater than the suggested retail price
    //         }

    //         $batchData[] = [
    //             'product_variant_id' => $productVariantId,
    //             'external_invoice_id' => rand(1, $externalInvoicesCount),
    //             'suggested_retail_price' => $price,
    //             'purchase_price_net' => $randomNetPrice,
    //             'purchase_price_gross' => $this->convertNetToGross($randomNetPrice, 23),
    //             'color_id' => $colors[array_rand($colors)],
    //             'vat_rate_id' => $vatRate,
    //             'brand_id' => $brandId,
    //             'status' => 0,
    //             'sale_id' => null,
    //             'store_id' => $storeId,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ];

    //         // Once we reach the batch size, insert the data
    //         if (count($batchData) >= $batchSize) {
    //             DB::table('stock_items')->insert($batchData);
    //             $batchData = []; // Reset the array after the batch insert
    //             $totalInserted += $batchSize;

    //             // Display a message every 10,000 records inserted
    //             if ($totalInserted % 10000 == 0) {
    //                 echo "Inserted {$totalInserted} stock items into the database.\n";
    //             }
    //         }
    //     }

    //     // Insert any remaining data that didn't reach the batch size
    //     if (!empty($batchData)) {
    //         DB::table('stock_items')->insert($batchData);
    //         $totalInserted += count($batchData);
    //         echo "Inserted {$totalInserted} stock items into the database.\n";
    //     }

    //     $colors = null;

    //     $productVariants = null;
    //     $stores = null;
    //     $brands = null;

    //     $batchSize = null;
    //     $totalInserted = null;
    //     $batchData = null;

    // }

    public function run(): void
    {
        // Fetch all non-temporary external invoices
        $externalInvoices = ExternalInvoice::where('is_temp', 0)->get();

        // Array of all colors, stores, product variants, and brands
        $colors = Color::all()->pluck('id')->toArray();
        $productVariants = ProductVariant::all()->pluck('id')->toArray();
        $stores = Store::all()->pluck('id')->toArray();
        $brands = Brand::all()->pluck('id')->toArray();
        $vatRate = VatRate::getDefault()->id;

        $batchSize = 1000; // Define batch size
        $batchData = [];
        $totalInserted = 0;

        foreach ($externalInvoices as $invoice) {
            // Randomly decide how many stock items to create for this invoice (between 5 and 65)
            $itemsCount = rand(5, 65);

            for ($i = 0; $i < $itemsCount; $i++) {
                $color = $colors[array_rand($colors)];
                $productVariantId = $productVariants[array_rand($productVariants)];
                $storeId = $stores[array_rand($stores)];
                $brandId = $brands[array_rand($brands)];
                $price = rand(1,5) === 1 ? 0 : $this->getRandomPrice();
                $randomNetPrice = rand(100, 5000);

                while (($randomNetPrice > $price) && ($price > 0)) {
                    $randomNetPrice = rand(100, 5000);
                }

                $batchData[] = [
                    'product_variant_id' => $productVariantId,
                    'external_invoice_id' => $invoice->id, // Assign stock item to current invoice
                    'suggested_retail_price' => $price,
                    'purchase_price_net' => $randomNetPrice,
                    'purchase_price_gross' => $this->convertNetToGross($randomNetPrice, 23),
                    'color_id' => $color,
                    'vat_rate_id' => $vatRate,
                    'brand_id' => $brandId,
                    'status' => 0,
                    'sale_id' => null,
                    'store_id' => $storeId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Insert batch if reached batch size
                if (count($batchData) >= $batchSize) {
                    DB::table('stock_items')->insert($batchData);
                    $totalInserted += $batchSize;
                    $batchData = [];
                    echo "Inserted {$totalInserted} stock items into the database.\n";
                }
            }
        }

        // Insert remaining data
        if (!empty($batchData)) {
            DB::table('stock_items')->insert($batchData);
            $totalInserted += count($batchData);
            echo "Inserted {$totalInserted} stock items into the database.\n";
        }

        // Free memory
        $colors = null;
        $productVariants = null;
        $stores = null;
        $brands = null;
        $batchData = null;
}

}
