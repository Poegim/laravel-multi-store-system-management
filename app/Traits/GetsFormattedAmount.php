<?php

namespace App\Traits;

trait GetsFormattedAmount

{
    // Method to get price in formatted currency
    public function getFormattedAmount($price): string
    {
                // Check if price is 0
                if ($price === 0) {
                    return number_format(0, 2);
                }

                // Convert price from cents to currency (if stored in cents)
                $priceInCurrency = $price / 100;

                // Format price with 2 decimal places
                return number_format($priceInCurrency, 2); // e.g. 19.99
    }
}
