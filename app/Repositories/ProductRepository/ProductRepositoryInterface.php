<?php

namespace App\Repositories\ProductRepository ;

use App\Models\Warehouse\Product;

interface ProductRepositoryInterface
{
    public function store(array $data);
    public function update(array $data, Product $product);
}