<?php

namespace Database\Seeders;

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

        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $brandIds = DB::table('brands')->pluck('id')->toArray();

        $faker = Faker::create();

        $numberOfProducts = 500;

        for ($i = 0; $i < $numberOfProducts; $i++) {
            $categoryId = $categoryIds[array_rand($categoryIds)];
            $brandId = $brandIds[array_rand($brandIds)];

            $productName = implode(' ', $faker->randomElements($words, rand(1, 3)));
            $productName = ucwords($productName.' '.$faker->words(rand(1,3), true)).rand(1,10);

            $data[] = [
                'category_id' => $categoryId,
                'brand_id' => $brandId,
                'name' => $productName,
                'slug' => Str::slug($productName),
                'is_device' => false,
                'created_at' => now(),
                'updated_at' => now()
            ];


        }

        DB::table('products')->insert($data);
    }
}
