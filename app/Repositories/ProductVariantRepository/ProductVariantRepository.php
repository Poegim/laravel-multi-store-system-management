<?php

namespace App\Repositories\ProductVariantRepository ;

use App\Traits\FormatsAmount;
use Illuminate\Support\Carbon;
use App\Models\Warehouse\ProductVariant;

class ProductVariantRepository implements ProductVariantRepositoryInterface
{

    use FormatsAmount;

    public function store(array $data)
    {
        $productVariant = new ProductVariant;
        $productVariant = $this->associate($productVariant, $data);
        $productVariant->user_id = auth()->user()->id;
        $productVariant->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $productVariant->save();
        isset($data['features']) && $productVariant->features()->sync($data['features']);
        isset($data['devices']) && $productVariant->devices()->sync($data['devices']);
    }
    
    public function update(array $data, ProductVariant $productVariant)
    {
        $productVariant = $this->associate($productVariant, $data);
        $productVariant->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $productVariant->save();
        isset($data['features']) && $productVariant->features()->sync($data['features']);
        isset($data['devices']) && $productVariant->devices()->sync($data['devices']);
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
