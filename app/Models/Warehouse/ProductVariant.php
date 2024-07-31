<?php

namespace App\Models\Warehouse;

use App\Models\Warehouse\Feature;
use App\Models\Warehouse\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariant extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'product_variants_features')
                    ->withPivot('value');
    }


}
