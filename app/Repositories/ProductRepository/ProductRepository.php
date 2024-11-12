<?php

namespace App\Repositories\ProductRepository ;

use App\Models\Warehouse\Product;
use App\Models\Warehouse\ProductVariant;

class ProductRepository implements ProductRepositoryInterface
{
    public function store(array $data) {
        $product = new Product;
        $product = $this->associate($product, $data);
        $product->user_id = auth()->user()->id;

        if ($product->save()) {
            $defaultVariant = new ProductVariant;
            $defaultVariant->name = 'Default';
            $defaultVariant->slug = 'default';
            $defaultVariant->product_id = $product->id;
            $defaultVariant->suggested_retail_price =  0;
            $defaultVariant->user_id = auth()->user()->id;

            return $defaultVariant->save();
        }

        abort(403, 'Unknown error while creating product');
    }

    public function update(array $data, Product $product) {
        $product = $this->associate($product, $data);
        return $product->save();
    }

    private function associate(Product $product, array $data)
    {
        $product->name = $data['name'];
        $product->slug = $data['slug'];
        $product->is_device = $data['is_device'];
        $product->category_id = $data['category_id'];
        $product->brand_id = $data['brand_id'];
        return $product;
    }
}
