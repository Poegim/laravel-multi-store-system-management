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

    // public static function boot()
    // {
    //     parent::boot();

    //     //Validate is slug and brand_id together unique.
    //     static::saving(function ($product) {
    //         $query = static::where('slug', $product->slug)
    //                        ->where('brand_id', $product->brand_id);

    //         if ($product->exists) {
    //             $query->where('id', '!=', $product->id);
    //         }

    //         if ($query->exists()) {
    //             throw ValidationException::withMessages([
    //                 'slug' => 'The combination of slug and brand_id must be unique.',
    //             ]);
    //         }
    //     });
    // }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // public function brand(): BelongsTo
    // {
    //     return $this->belongsTo(Brand::class);
    // }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function compatibleVariants()
    {
        return $this->belongsToMany(ProductVariant::class, 'product_variant_device', 'device_id', 'product_variant_id');
    }
}
