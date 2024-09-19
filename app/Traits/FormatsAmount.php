<?php

namespace App\Traits;

trait FormatsAmount
{
    /**
     * Formats a value given in cents (for prices) or as a whole number (for percentages)
     * to a string with two decimal places.
     *
     * @param int $amount Value in cents (for prices) or as a whole number (for percentages)
     * @return string Formatted value with two decimal places
     */
    // public function formatAmount(int $amount): string
    // {
    //     if ($this->amount === 0) {
    //         return '0.00';
    //     }

    //     // Divide by 100 to convert to a format with two decimal places
    //     return number_format($amount / 100, 2, '.', '');
    // }

}
