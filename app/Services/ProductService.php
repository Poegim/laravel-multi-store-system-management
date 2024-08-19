<?php

namespace App\Services;

use App\Models\Warehouse\Product;
use App\Repositories\ProductRepository\ProductRepositoryInterface;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {}

    public function store(array $data) {
        return $this->productRepository->store($data);
    }

    public function update(array $data, Product $product)
    {
        return $this->productRepository->update($data, $product);
    }

}