<?php

namespace App\Traits;

trait FormatsAmount
{
    /**
     * Convert value from decimal to Integer
     *
     * @param  float  $value  Decimal value (ex. 222.22).
     * @return int            Integer (ex. 22222).
     */
    public function decimalToInteger(float $value = 0.00): int
    {
        if ($value === 0.00) {
            return 0;
        }

        if($value < 0) {
            abort(403);
        }

        return (int) round($value * 100);
    }

    /**
     * Converts integer to float.
     *
     * @param  int    $value  Integer (ex. 22222).
     * @return float          Float (ex. 222.22).
     */
    public function integerToDecimal(int $value = 0): float
    {
        if ($this->value === 0) {
            return 0;
        }

        if($value < 0) {
            abort(403);
        }

        return number_format($value / 100, 2, '.', '');
    }

}
