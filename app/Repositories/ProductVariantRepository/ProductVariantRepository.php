<?php

namespace App\Repositories\ProductVariantRepository ;

use App\Models\Warehouse\ProductVariant;

class ProductVariantRepository implements ProductVariantRepositoryInterface
{
    public function store(array $data) {
        $productVariant = new ProductVariant;
        $productVariant = $this->associate($productVariant, $data);
        return $productVariant->save();
    }

    public function update(array $data, ProductVariant $productVariant) {
        $productVariant = $this->associate($productVariant, $data);
        return $productVariant->save();
    }

    private function associate(ProductVariant $productVariant, array $data)
    {
        $productVariant->name = $data['name'];
        // $productVariant->slug = $data['slug'];
        // $productVariant->is_device = $data['is_device'];
        // $productVariant->category_id = $data['category_id'];
        // $productVariant->brand_id = $data['brand_id'];
        return $productVariant;
    }
}
