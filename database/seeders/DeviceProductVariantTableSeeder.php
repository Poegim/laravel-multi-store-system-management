<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Warehouse\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeviceProductVariantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variants = ProductVariant::all();
        $devices = Product::devices()->get();
        $batchData = [];
        $batchSize = 1000; // Set the desired batch size
        
        foreach ($variants as $variant) {
            $deviceCount = rand(1, 5);
        
            $selectedDevices = $devices->random($deviceCount);
        
            foreach ($selectedDevices as $device) {
                $batchData[] = [
                    'product_variant_id' => $variant->id,
                    'device_id' => $device->id,
                ];
        
                // If the batch size limit is reached, insert the data and reset the array
                if (count($batchData) >= $batchSize) {
                    DB::table('device_product_variant')->insert($batchData);
                    $batchData = []; // Reset after insert
                }
            }
        }
        
        // Insert any remaining data that didn't reach the batch size
        if (!empty($batchData)) {
            DB::table('device_product_variant')->insert($batchData);
        }

        $variants = null;
        $devices = null;
    }
}
