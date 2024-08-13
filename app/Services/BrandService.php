<?php

namespace App\Services;

use App\Models\Warehouse\Brand;
use App\Repositories\BrandRepository\BrandRepositoryInterface;

class BrandService
{
    public function __construct(
        protected BrandRepositoryInterface $brandRepository
    ) {}

    public function store(array $data) {
        return $this->brandRepository->store($data);
    }

    public function update(array $data, Brand $brand)
    {
        return $this->brandRepository->update($data, $brand);
    }

}