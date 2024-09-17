<?php

namespace App\Traits;

trait GetRandomPrice
{
    public function getRandomPrice() : int
    {
        $price = rand(1, 19);
        $lastDigitOptions = [0, 5, 9];
        $lastDigit = $lastDigitOptions[array_rand($lastDigitOptions)];
        $price = $this->concatenateIntegers($price, $lastDigit);

        $lastDigit = rand(1,20) == 1 ? rand(1,99) : '00';

        return $this->concatenateIntegers($price, $lastDigit);
    }

    private function concatenateIntegers($a, $b)
    {
        return (int) ($a . $b);
    }

}
