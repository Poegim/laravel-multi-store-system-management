<?php

namespace App\Traits;

trait NetToGrossConverts
{
    public function convertNetToGross(int $netPrice, int $vatRate): int
    {
        return (int) round($netPrice * (1 + $vatRate / 100));
    }
}
