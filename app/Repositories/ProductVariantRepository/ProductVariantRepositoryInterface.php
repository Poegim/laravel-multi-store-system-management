<?php

namespace App\Repositories\ProductVariantRepository ;

use App\Models\Warehouse\ProductVariant;

interface ProductVariantRepositoryInterface
{
    public function store(array $data);
    public function update(array $data, ProductVariant $productVariant);
}