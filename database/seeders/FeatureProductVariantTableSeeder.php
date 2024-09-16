<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse\Feature;
use Illuminate\Support\Facades\DB;
use App\Models\Warehouse\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeatureProductVariantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

                // Pobranie wszystkich ID wariantów produktów i cech
                $productVariants = ProductVariant::all()->pluck('id')->toArray();
                $features = Feature::all()->pluck('id')->toArray();
        
                // Tablica do przechowywania danych do batch insert
                $insertData = [];
        
                // Przejście przez każdy wariant produktu
                foreach ($productVariants as $productVariantId) {
                    // Wylosowanie liczby cech (od 1 do 5)
                    $randomFeatureCount = rand(1, 5);
        
                    // Wylosowanie losowych cech
                    $randomFeatures = array_rand(array_flip($features), $randomFeatureCount);
        
                    // Jeśli tylko jedna cecha jest wybrana, upewnij się, że będzie to tablica
                    if (!is_array($randomFeatures)) {
                        $randomFeatures = [$randomFeatures];
                    }
        
                    // Dodanie wylosowanych cech do tablicy do wstawienia
                    foreach ($randomFeatures as $featureId) {
                        $insertData[] = [
                            'product_variant_id' => $productVariantId,
                            'feature_id' => $featureId,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                }
        
                // Wstawienie wszystkich danych w jednej operacji batch insert
                DB::table('feature_product_variant')->insert($insertData);

    }
}
