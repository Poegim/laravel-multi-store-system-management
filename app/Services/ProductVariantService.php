<?php

namespace App\Services;

use App\Models\Warehouse\ProductVariant;
use App\Repositories\ProductVariantRepository\ProductVariantRepositoryInterface;

class ProductVariantService
{
    public function __construct(
        protected ProductVariantRepositoryInterface $productVariantRepository
    ) {}

    public function store(array $data) {
        return $this->productVariantRepository->store($data);
    }

    public function update(array $data, ProductVariant $productVariant)
    {
        return $this->productVariantRepository->update($data, $productVariant);
    }

}