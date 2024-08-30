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
            "Quick Charge" => "QC",
            "Power Delivery" => "PD",
            "20W" => NULL,
            "25W" => NULL,
            "33W" => NULL,
            "45W" => NULL,
            "60W" => NULL,
            "65W" => NULL,
            "USB 2.0" => NULL,
            "USB 3.0" => NULL,
            "USB 3.1" => NULL,
            "MagSafe" => "MAG",
            "Do szyby" => NULL,
            "Do kratki" => NULL,
            "Magnetyczny" => NULL,
            "Bezprzewodowy/e" => NULL,
            "USB-C" => NULL,
            "USB-C USB-A" => "CA",
            "USB-C USB-C" => "CC",
            "USB-C Lightning" => "CL",
            "Lightning" => NULL,
            "Micro USB" => NULL,
            "Wodoodporny" => NULL,
            "Dual SIM" => NULL,
            "Jack 3.5mm" => "3.5mm",
            "NFC" => NULL,
            "Bluetooth" => "BT",
            "WiFi" => NULL,
            "Głośnomówiący" => NULL,
            "MFi" => NULL,
            "Android" => NULL,
            "iOS" => NULL,
            "1m" => NULL,
            "1.5m" => NULL,
            "2m" => NULL,
            "3m" => NULL,
            "50cm" => NULL,
            "25cm" => NULL,
        ];

        foreach($features as $key => $feature) {
            DB::table('features')->insert([
                'name' => $key,
                'short_name' => $feature !== null ? $feature : null,
                'slug' => Str::slug($key),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

    }
}
