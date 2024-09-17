<?php

namespace App\Traits;

trait HasFormattedSRP
{
    use GetsFormattedAmount;

    public function formattedSRP()
    {
        return $this->getFormattedAmount($this->suggested_retail_price);
    }
}
