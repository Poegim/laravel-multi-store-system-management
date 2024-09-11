<?php

namespace App\Models\Warehouse;

use App\Models\Warehouse\Feature;
use App\Models\Warehouse\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductVariant extends Model
{
    use HasFactory;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'product_variants_features')
                    ->withPivot('value');
    }

    public function devices(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'device_product_variant', 'product_variant_id', 'device_id');
    }


}
