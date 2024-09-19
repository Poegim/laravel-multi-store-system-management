<?php

namespace App\Traits;

trait GrossToNetConverts
{
    public function grossToNetConverts(int $netPrice, int $vatRate): int
    {
        return (int) round($netPrice * (1 + $vatRate / 100));
    }
}
