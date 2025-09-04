<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\VatRate;
use App\Traits\GetRandomPrice;
use App\Models\Warehouse\Brand;
use Illuminate\Database\Seeder;
use App\Models\Warehouse\Product;
use App\Traits\NetToGrossConverts;
use Illuminate\Support\Facades\DB;
use App\Models\Commerce\ExternalInvoice;
use App\Models\Warehouse\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TemporaryExternalInvoiceItemsTableSeeder extends Seeder
{

    use GetRandomPrice;
    use NetToGrossConverts;

    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {

    //     $colors = Color::all()->pluck('id')->toArray();

    //     // Fetch all product variants to randomly assign to stock items
    //     $productVariants = ProductVariant::all()->pluck('id')->toArray();

    //     $tempInvoices = ExternalInvoice::where('is_temp', true)->get();
    //     $brands = Brand::all()->pluck('id')->toArray();
    //     $vatRate = VatRate::getDefault()->id;
    //     $devices = Product::devices()->get()->pluck('id')->toArray();

    //     foreach($tempInvoices as $tempInvoice) {

    //         $batchSize = 1000; // Define batch size
    //         $totalInserted = 0; // Counter to track total inserted records
    //         $batchData = [];

    //         for ($i = 0; $i < rand(1,3); $i++) { // Adjust loop for desired number of stock items
    //             // Randomly select a color, store and product_variant_id
                
    //             $productVariantId = $productVariants[array_rand($productVariants)];
    //             $brandId = $brands[array_rand($brands)];
    //             $price = rand(1,5) === 1 ? 0 : $this->getRandomPrice();

    //             $batchData[] = [
    //                 'product_variant_id' => $productVariantId,
    //                 'device_id' => $devices[array_rand($devices)],
    //                 'external_invoice_id' => $tempInvoice->id,
    //                 'suggested_retail_price' => $price,
    //                 'purchase_price_net' => 1000,
    //                 'purchase_price_gross' => $this->convertNetToGross(1000, 23),
    //                 'color_id' => $colors[array_rand($colors)],
    //                 'vat_rate_id' => $vatRate,
    //                 'brand_id' => $brandId,
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ];

    //             // Once we reach the batch size, insert the data
    //             if (count($batchData) >= $batchSize) {
    //                 DB::table('temporary_external_invoice_items')->insert($batchData);
    //                 $batchData = []; // Reset the array after the batch insert
    //                 $totalInserted += $batchSize;
    //             }
    //         }

    //         // Insert any remaining data that didn't reach the batch size
    //         if (!empty($batchData)) {
    //             DB::table('temporary_external_invoice_items')->insert($batchData);
    //             $totalInserted += count($batchData);
    //             echo "Inserted {$totalInserted} stock items into the database.\n";
    //         }
    //     }
    // }

    public function run(): void
    {
        // Fetch all colors, product variants, brands, devices and default VAT rate
        $colors = Color::all()->pluck('id')->toArray();
        $productVariants = ProductVariant::all()->pluck('id')->toArray();
        $brands = Brand::all()->pluck('id')->toArray();
        $devices = Product::devices()->get()->pluck('id')->toArray();
        $vatRate = VatRate::getDefault()->id;

        // Fetch all temporary external invoices
        $tempInvoices = ExternalInvoice::where('is_temp', 1)->get();

        $batchSize = 1000; // Define batch size
        $batchData = [];
        $totalInserted = 0;

        foreach ($tempInvoices as $invoice) {
            // Randomly decide how many stock items to create for this temporary invoice (between 1 and 3)
            $itemsCount = rand(1, 3);

            for ($i = 0; $i < $itemsCount; $i++) {
                $productVariantId = $productVariants[array_rand($productVariants)];
                $brandId = $brands[array_rand($brands)];
                $deviceId = $devices[array_rand($devices)];
                $colorId = $colors[array_rand($colors)];
                $price = rand(1,5) === 1 ? 0 : $this->getRandomPrice();

                $batchData[] = [
                    'product_variant_id' => $productVariantId,
                    'device_id' => $deviceId,
                    'external_invoice_id' => $invoice->id,
                    'suggested_retail_price' => $price,
                    'purchase_price_net' => 1000, // Fixed net price for temporary items
                    'purchase_price_gross' => $this->convertNetToGross(1000, 23),
                    'color_id' => $colorId,
                    'vat_rate_id' => $vatRate,
                    'brand_id' => $brandId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Insert batch if reached batch size
                if (count($batchData) >= $batchSize) {
                    DB::table('temporary_external_invoice_items')->insert($batchData);
                    $totalInserted += $batchSize;
                    $batchData = [];
                }
            }
        }

        // Insert any remaining data
        if (!empty($batchData)) {
            DB::table('temporary_external_invoice_items')->insert($batchData);
            $totalInserted += count($batchData);
        }

        echo "Inserted {$totalInserted} temporary stock items into the database.\n";

        // Free memory
        $colors = null;
        $productVariants = null;
        $brands = null;
        $devices = null;
        $batchData = null;
    }

}
