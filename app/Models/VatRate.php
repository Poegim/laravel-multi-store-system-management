<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VatRate extends Model
{
    use HasFactory;

    /**
     * Boot method for model events.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($vatRate) {
            if ($vatRate->is_default) {
                // Ensure only one default VAT rate exists
                self::where('is_default', true)->update(['is_default' => false]);
            }
        });
    }

    /**
     * Retrieve the default VAT rate.
     *
     * @return self|null
     */
    public static function getDefault(): ?self
    {
        return self::where('is_default', true)->first();
    }

    /**
     * Set this VAT rate as the default.
     *
     * @return void
     */
    public function makeDefault(): void
    {
        // Update all other records to not be default
        self::where('is_default', true)->update(['is_default' => false]);

        // Set this record as the default
        $this->update(['is_default' => true]);
    }

}
