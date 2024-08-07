<?php

namespace App\Models\Warehouse;

use App\Models\Warehouse\Brand;
use App\Models\Warehouse\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        //Validate is name and brand_id together unique.
        static::saving(function ($product) {
            $query = static::where('name', $product->name)
                           ->where('brand_id', $product->brand_id);

            if ($product->exists) {
                $query->where('id', '!=', $product->id);
            }

            if ($query->exists()) {
                throw ValidationException::withMessages([
                    'name' => 'The combination of name and brand_id must be unique.',
                ]);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
