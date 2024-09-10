<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Contacts\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('pl_PL');
        $batchSize = 1000;
        
        $data = [];
        for ($i = 0; $i < 10000; $i++) {
            $data[] = [
                'name' => $faker->company(),
                'nip' => $faker->randomNumber(9),
                'country' => 'Polska',
                'city' => $faker->city(),
                'postcode' => $faker->postcode(),
                'street' => $faker->streetName(),
                'building_number' => $faker->buildingNumber(),
            ];
        
            // Wstaw dane w partiach po 1000
            if (count($data) >= $batchSize) {
                Company::insert($data);
                $data = []; // Opróżnij tablicę po wstawieniu
            }
        }
        
        // Wstaw pozostałe dane, jeśli są
        if (!empty($data)) {
            Company::insert($data);
        }
    }
}
