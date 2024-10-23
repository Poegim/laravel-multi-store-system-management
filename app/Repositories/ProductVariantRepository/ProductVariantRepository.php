<?php

namespace App\Repositories\ProductVariantRepository ;

use App\Models\Warehouse\ProductVariant;

class ProductVariantRepository implements ProductVariantRepositoryInterface
{
    public function store(array $data) {
        $productVariant = new ProductVariant;
        $productVariant = $this->associate($productVariant, $data);
        $productVariant->save();
        isset($data['features']) && $productVariant->features()->sync($data['features']);
        isset($data['devices']) && $productVariant->devices()->sync($data['devices']);
    }

    public function update(array $data, ProductVariant $productVariant) {
        $productVariant = $this->associate($productVariant, $data);
        return $productVariant->save();
    }

    private function associate(ProductVariant $productVariant, array $data)
    {
        $productVariant->name = $data['name'];
        $productVariant->slug = $data['slug'];
        $productVariant->ean = $data['ean'];
        $productVariant->product_id = $data['product_id'];

        return $productVariant;
    }

}
