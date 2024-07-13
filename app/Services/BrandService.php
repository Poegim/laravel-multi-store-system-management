<?php

namespace App\Services;

use App\Repositories\BrandRepository\BrandRepositoryInterface;

class BrandService
{
    public function __construct(
        protected BrandRepositoryInterface $brandRepository
    ) {}

    public function store(array $data) {
        return $this->brandRepository->store($data);
    }

    public function update(array $data, $id)
    {
        return $this->brandRepository->update($data, $id);
    }

}