<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            "Quick Charge",
            "Power Delivery",
            "20W",
            "25W",
            "33W",
            "45W",
            "60W",
            "65W",
            "USB 2.0",
            "USB 3.0",
            "USB 3.1",
            "MagSafe",
            "Do szyby",
            "Do kratki",
            "Magnetyczny",
            "Bezprzewodowy/e",
            "USB-C",
            "Lightning",
            "Micro USB",
            "Wodoodporny",
            "Dual SIM",
            "Jack 3.5mm",
            "NFC",
            "Bluetooth",
            "WiFi",
            "Głośnomówiący",
            "MFi",
            "Android",
            "iOS"
        ];

        foreach($features as $feature) {
            DB::table('features')->insert([
                'name' => $feature,
                'short_name' => NULL,
                'slug' => Str::slug($feature),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

    }
}
