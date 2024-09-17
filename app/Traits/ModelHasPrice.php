<?php

namespace App\Traits;

trait ModelHasPrice
{
    // Mutator - converts the price to cents before saving it to the database
    // public function setPriceAttribute($value)
    // {
    //     // Save the price as an integer in cents (e.g. 19.99 => 1999)
    //     $this->attributes['price'] = $value * 100;
    // }

    // Accessor - converts the price from cents to currency when retrieving it
    // public function getPriceAttribute($value)
    // {
    //     // Convert the price from cents to currency (e.g. 1999 => 19.99)
    //     return $value / 100;
    // }

    // Method to get price in cents
    public function price()
    {
        return $this->price;
    }

    // Method to get price in formatted currency
    public function getFormattedPrice()
    {
                // Check if price is 0
                if ($this->price === 0) {
                    return 0;
                }

                // Convert price from cents to currency (if stored in cents)
                $priceInCurrency = $this->price / 100;

                // Format price with 2 decimal places
                return number_format($priceInCurrency, 2); // e.g. 19.99
    }
}
