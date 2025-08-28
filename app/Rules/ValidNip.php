<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidNip implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Normalize: remove all non-digit characters
        $nip = preg_replace('/\D+/', '', (string) $value);

        // Must have exactly 10 digits
        if (strlen($nip) !== 10) {
            $fail('The '.$attribute.' must be exactly 10 digits.');
            return;
        }

        // Convert to array of ints
        $digits = array_map('intval', str_split($nip));

        // Weights for checksum
        $weights = [6, 5, 7, 2, 3, 4, 5, 6, 7];

        // Calculate weighted sum
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += $weights[$i] * $digits[$i];
        }

        $control = $sum % 11;

        // If control is 10, it's invalid
        if ($control === 10 || $control !== $digits[9]) {
            $fail('The '.$attribute.' is not a valid NIP number.');
        }
    }
}
