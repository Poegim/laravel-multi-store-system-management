<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(FeaturesTableSeeder::class);
        $this->call(ProductVariantsTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(DeviceProductVariantTableSeeder::class);
        $this->call(StockItemsTableSeeder::class);
        $this->call(FeatureProductVariantTableSeeder::class);
    }
}
