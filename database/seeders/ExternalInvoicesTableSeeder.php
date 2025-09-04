<?php

namespace Database\Seeders;

use App\Models\Commerce\ExternalInvoice;
use App\Models\Contact;
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
    // public function run(): void
    // {

    //     $data = [];
    //     $faker = Factory::create();
    //     $contacts = Contact::companies()->pluck('id');
        

    //     for ($i=0; $i < 200; $i++) {
    //         $data[$i] = [
    //             'invoice_number' => 'INV-' . date('Y') . '-' . $faker->unique()->numberBetween(10, 999999),
    //             'store_id' => rand(1,5),
    //             'user_id' => rand(1,5),
    //             'contact_id' => $contacts->random(),
    //             'price' => 0,
    //             'is_temp' => ExternalInvoice::COMPLETED,
    //             'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
    //             'updated_at' => now()
    //         ];
    //     }

    //     DB::table('external_invoices')->insert($data);

    //     for ($i=0; $i < 10; $i++) {
    //         $data[$i] = [
    //             'invoice_number' => 'INV-' . date('Y') . '-' . $faker->unique()->numberBetween(10, 99999),
    //             'store_id' => rand(1,5),
    //             'user_id' => rand(1,5),
    //             'contact_id' => $contacts->random(),
    //             'price' => 0,
    //             'is_temp' => ExternalInvoice::TEMPORARY,
    //             'created_at' => now(),
    //             'updated_at' => now()
    //         ];
    //     }

    //     DB::table('external_invoices')->insert($data);


    // }

    public function run(): void
    {
        $faker = Factory::create();
        $contacts = Contact::companies()->pluck('id');

        // First batch: completed invoices
        $completedData = [];
        for ($i = 0; $i < 200; $i++) {
            $completedData[] = [
                'invoice_number' => 'INV-' . date('Y') . '-' . $faker->unique()->numberBetween(10000, 999999),
                'store_id' => rand(1,5),
                'user_id' => rand(1,5),
                'contact_id' => $contacts->random(),
                'price' => 0,
                'is_temp' => ExternalInvoice::COMPLETED,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now()
            ];
        }
        DB::table('external_invoices')->insert($completedData);

        // Second batch: temporary invoices
        $temporaryData = [];
        for ($i = 0; $i < 10; $i++) {
            $temporaryData[] = [
                'invoice_number' => 'INV-' . date('Y') . '-' . $faker->unique()->numberBetween(10000, 999999),
                'store_id' => rand(1,5),
                'user_id' => rand(1,5),
                'contact_id' => $contacts->random(),
                'price' => 0,
                'is_temp' => ExternalInvoice::TEMPORARY,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('external_invoices')->insert($temporaryData);
    }

}
