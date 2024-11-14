<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse\ProductVariant;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;
    use BelongsToUser;

    public function productVariants()
    {
        return $this->belongsToMany(ProductVariant::class, 'feature_product_variant', 'feature_id', 'product_variant_id');
    }

    public function totalStockItemsCount()
    {
        return ProductVariant::join('feature_product_variant', 'product_variants.id', '=', 'feature_product_variant.product_variant_id')
                             ->join('stock_items', 'product_variants.id', '=', 'stock_items.product_variant_id')
                             ->where('feature_product_variant.feature_id', $this->id)
                             ->count('stock_items.id');
    }

}
