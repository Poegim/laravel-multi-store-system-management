<?php

namespace Database\Factories\Commerce;

use App\Models\Commerce\ExternalInvoice;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExternalInvoiceFactory extends Factory
{
    protected $model = ExternalInvoice::class;

    // Przechowujemy listę kontaktów w statycznej zmiennej (ładowane raz)
    protected static ?array $contactIds = null;

    public function definition(): array
    {
        static $invoiceCounter = 1;

        // Pobierz kontakty tylko raz
        if (self::$contactIds === null) {
            self::$contactIds = Contact::companies()->pluck('id')->all();
        }

        return [
            'invoice_number' => 'INV-' . date('Y') . '-' . str_pad($invoiceCounter++, 6, '0', STR_PAD_LEFT),
            'store_id' => $this->faker->numberBetween(1, 5),
            'user_id' => $this->faker->numberBetween(1, 5),
            'contact_id' => $this->faker->randomElement(self::$contactIds), // wybieramy z pamięci
            'is_temp' => ExternalInvoice::COMPLETED,
            'created_at' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s'),
            'updated_at' => now()->format('Y-m-d H:i:s'),
        ];
    }
}
