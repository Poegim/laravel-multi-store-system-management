<?php

namespace Database\Seeders;

use App\Models\Warehouse\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Akcesoria' => [
                'singular_name' => 'Akcesorium',
                'subcategories' => [
                    'Adaptery' => 'Adapter',
                    'Akcesoria do tabletów' => 'Akcesorium do tabletu',
                    'Akcesoria sportowe' => 'Akcesorium sportowe',
                    'Akcesoria zimowe' => 'Akcesorium zimowe',
                    'Akumulatory i baterie' => [
                        'singular_name' => 'Akumulator i bateria',
                        'subcategories' => [
                            'Baterie' => 'Bateria',
                            'Powerbanki' => 'Powerbank',
                        ]
                    ],
                    'Ochrona wyświetlaczy' => 'Ochrona wyświetlacza',
                    'Głośniki' => 'Głośnik',
                    'Kable' => 'Kabel',
                    'Pamięć masowa' => [
                        'singular_name' => 'Pamięć masowa',
                        'subcategories' => [
                            'Pendrive' => 'Pendrive',
                            'Karty pamięci' => 'Karta pamięci',
                        ]
                    ],
                    'Ładowarki' => [
                        'singular_name' => 'Ładowarka',
                        'subcategories' => [
                            'Ładowarki sieciowe' => 'Ładowarka sieciowa',
                            'Ładowarki samochodowe' => 'Ładowarka samochodowa',
                        ]
                    ],
                    'Monopody' => 'Monopod',
                    'Papierosy' => 'Papieros',
                    'Pendrive' => 'Pendrive',
                    'Pokrowce' => [
                        'singular_name' => 'Pokrowiec',
                        'subcategories' => [
                            'Etui naramiennie' => 'Etui naramienne',
                            'Etui z klapką' => 'Etui z klapką',
                            'Kabura' => 'Kabura',
                            'Nakładki' => 'Nakładka',
                            'Wodoszczelne' => 'Pokrowiec wodoszczelny',
                            'Wsuwki' => 'Wsuwka',
                        ]
                    ],
                    'Rysiki' => 'Rysik',
                    'Statywy' => [
                        'singular_name' => 'Statyw',
                        'subcategories' => [
                            'Selfie sticki' => 'Selfie stick',
                        ]
                    ],
                    'Uchwyty samochodowe' => 'Uchwyt samochodowy',
                    'Zestawy słuchawkowe' => [
                        'singular_name' => 'Zestaw słuchawkowy',
                        'subcategories' => [
                            'Zestawy bezprzewodowe' => 'Zestaw bezprzewodowy',
                            'Zestawy przewodowe' => 'Zestaw przewodowy',
                        ]
                    ],
                ]
            ],
            'Urządzenia' => [
                'singular_name' => 'Urządzenie',
                'subcategories' => [
                    'E-papierosy' => 'E-papieros',
                    'Modemy' => 'Modem',
                    'Tablety' => 'Tablet',
                    'Telefony' => 'Telefon',
                ]
            ],
        ];

        $this->createCategories($categories);
    }

    private function createCategories(array $categories, int $parent_id = null): void
    {
        foreach ($categories as $category => $details) {
            // Plural form is always the key in the $categories array
            $plural = $category;
            // Singular form is either provided as 'singular_name' key in $details or it's the $details value itself
            $singular = is_array($details) ? $details['singular_name'] : $details;

            // Create the category with plural and singular names
            $categoryModel = Category::create([
                'parent_id' => $parent_id,
                'plural_name' => $plural,
                'singular_name' => $singular,
                'slug' => Str::slug($plural, '-'),
            ]);

            // If there are subcategories, recursively create them
            if (is_array($details) && isset($details['subcategories'])) {
                $this->createCategories($details['subcategories'], $categoryModel->id);
            }
        }

        
    }
    
}
