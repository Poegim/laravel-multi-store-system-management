<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse\ProductVariant;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;

    public function productVariants()
    {
        return $this->belongsToMany(ProductVariant::class, 'product_variants_features')
                    ->withPivot('value');
    }

}
