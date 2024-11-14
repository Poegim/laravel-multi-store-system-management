<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class ContactsTableSeeder extends Seeder
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

            $type = rand(1,2);
            if($type === 1) {
                $name = $faker->firstName();
                $surname = $faker->lastName();
            } else {
                $name = $faker->company();
                $surname = '';
            }

            $data[] = [
                'name' => $name,
                'surname' => $surname,
                'identification_number' => $faker->randomNumber(9),
                'type' => $type,
                'country' => 'Polska',
                'city' => $faker->city(),
                'postcode' => $faker->postcode(),
                'street' => $faker->streetName(),
                'building_number' => rand(1,199),
                'phone' => $faker->randomNumber(9),
                'user_id' => rand(1,5),
            ];

            // Wstaw dane w partiach po 1000
            if (count($data) >= $batchSize) {
                Contact::insert($data);
                $data = []; // Opróżnij tablicę po wstawieniu
            }
        }

        // Wstaw pozostałe dane, jeśli są
        if (!empty($data)) {
            Contact::insert($data);
        }

        $data = null;
    }
}
