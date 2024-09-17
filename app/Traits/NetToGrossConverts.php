<?php

namespace App\Traits;

trait NetToGrossConverts
{
    public function netToGrossConverts(int $grossPrice, int $vatRate): int
    {
        return (int) round($grossPrice / (1 + $vatRate / 100));
    }
}
