<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Warehouse\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductVariantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $faker = $faker = Faker::create();

        foreach($products as $product) {
            for ($i=0; $i < 2; $i++) {
                if($i === 0) {
                    DB::table('product_variants')->insert([
                        'name' => 'default',
                        'slug' => 'default',
                        'product_id' => $product->id,
                    ]);
                } else {
                    if(rand(1,2) === 1) {
                        $name = $faker->sentence(rand(1,3), true);
                        DB::table('product_variants')->insert([
                            'name' => $name,
                            'slug' => Str::slug($name),
                            'product_id' => $product->id,
                        ]);
                    }
                }
            }
        }
    }
}
