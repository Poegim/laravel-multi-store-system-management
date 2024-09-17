<?php

namespace App\Traits;

trait GrossToNetConverts
{
    public function convert(int $netPrice, int $vatRate): int
    {
        return (int) round($netPrice * (1 + $vatRate / 100));
    }
}
