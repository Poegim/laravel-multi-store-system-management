<?php

namespace App\Repositories\ProductRepository ;

use App\Models\Warehouse\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function store(array $data) {
        $product = new Product;
        $product = $this->associate($product, $data);
        return $product->save();
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
        // $product->brand_id = $data['brand_id'];
        return $product;
    }
}
