<?php

namespace Database\Seeders;

use App\Models\Warehouse\Brand;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $words = [
            'Alpha', 'Beta', 'Gamma', 'Delta', 'Echo', 'Foxtrot', 'Golf', 'Hotel', 'India', 'Juliet',
            'Kilo', 'Lima', 'Mike', 'November', 'Oscar', 'Papa', 'Quebec', 'Romeo', 'Sierra', 'Tango',
            'Uniform', 'Victor', 'Whiskey', 'X-ray', 'Yankee', 'Zulu', 'Red', 'Blue', 'Green', 'Yellow',
            'Purple', 'Black', 'White', 'Silver', 'Golden', 'Smart', 'Pro', 'Max', 'Ultra', 'Mini'
        ];
    
        $gsmProducts = [
            "Jelly Case", "Silicone Case", "Ładowarka samochodowa", "Ładowarka indukcyjna", 
            "Etui pancerne", "Powerbank", "Szkło hartowane", "Folia ochronna", "Kabel USB-C", 
            "Kabel Lightning", "Uchwyt samochodowy", "Etui na pas", "Słuchawki Bluetooth", 
            "Adapter USB-C na Jack 3,5mm", "Smartwatch", "Stacja dokująca", "Selfie stick", 
            "Uchwyt rowerowy", "Etui portfelowe", "PopSocket", "Głośnik Bluetooth", "Etui wodoodporne", 
            "Karta pamięci MicroSD", "Powerbank solarny", "Zestaw głośnomówiący", "Obiektyw do telefonu", 
            "Hub USB", "Klawiatura Bluetooth", "Rysik do smartfona", "Etui z funkcją stand", 
            "Rękawiczki dotykowe", "Bumper", "Etui magnetyczne", "Ładowarka sieciowa", "Kamera do smartfona", 
            "Zewnętrzna antena GSM", "Odbiornik TV do telefonu", "Etui z nadrukiem", "Osłona na aparat", 
            "Uchwyt na palec", "Etui skórzane", "Etui z baterią", "Organizer na kable", "Ekran prywatności", 
            "Etui z klapką", "Zestaw ładowania bezprzewodowego", "Lokalizator Bluetooth", "Słuchawki przewodowe", 
            "Smartband", "Etui przeciwpyłowe"
        ];
    
        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $brands = Brand::select(['id', 'name'])->get();
        
        $numberOfProducts = 300;
    
        $data = [];
    
        for ($i = 0; $i < $numberOfProducts; $i++) {
            $categoryId = $categoryIds[array_rand($categoryIds)];
    
            $brand = $brands->random();
            $brandId = $brand->id;
    
            $productName = $gsmProducts[rand(0, count($gsmProducts) - 1)] . ' ' . $words[rand(0, count($words) - 1)];
    
            $data[] = [
                'category_id' => $categoryId,
                'brand_id' => $brandId,
                'name' => $productName,
                'slug' => Str::slug($productName . '-' . $brand->name),
                'is_device' => false,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
    
        DB::table('products')->insert($data);
    }
}
