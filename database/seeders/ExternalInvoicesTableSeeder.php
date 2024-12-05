<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExternalInvoicesTableSeeder extends Seeder
{

    /**
     *      $table->string('invoice_number')->unique();
     *      $table->foreignId('store_id')->constrained();
     *      $table->foreignId('user_id')->constrained();
     *      $table->foreignId('contact_id')->constrained();
     *      $table->integer('price')->nullable();
     *      $table->boolean('is_temp')->default(true);
     */

    /*
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [];
        $faker = Factory::create();

        for ($i=0; $i < 200; $i++) {
            $data[$i] = [
                'invoice_number' => 'INV-' . date('Y') . '-' . $faker->unique()->numberBetween(10, 99999),
                'store_id' => rand(1,5),
                'user_id' => rand(1,5),
                'contact_id' => rand(1,500),
                'price' => 0,
                'is_temp' => rand(0,1),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('external_invoices')->insert($data);
    }
}
