<?php

namespace App\Repositories\ProductVariantRepository ;

use App\Models\Warehouse\ProductVariant;
use App\Traits\FormatsAmount;

class ProductVariantRepository implements ProductVariantRepositoryInterface
{

    use FormatsAmount;

    public function store(array $data) 
    {
        $productVariant = new ProductVariant;
        $productVariant = $this->associate($productVariant, $data);
        $productVariant->save();
        isset($data['features']) && $productVariant->features()->sync($data['features']);
        isset($data['devices']) && $productVariant->devices()->sync($data['devices']);
    }

    public function update(array $data, ProductVariant $productVariant): bool 
    {
        $productVariant = $this->associate($productVariant, $data);
        return $productVariant->save();
    }

    private function associate(ProductVariant $productVariant, array $data): ProductVariant
    {
        $productVariant->name = $data['name'];
        $productVariant->slug = $data['slug'];
        $productVariant->ean = $data['ean'];
        $productVariant->suggested_retail_price = $data['suggested_retail_price'] ? $this->decimalToInteger($data['suggested_retail_price']) : 0.00;
        $productVariant->product_id = $data['product_id'];

        return $productVariant;
    }

}
