<?php

namespace App\Services;

use App\Repositories\CategoryRespository\CategoryRespositoryInterface;

class CategoryService
{
    public function __construct(
        protected CategoryRespositoryInterface $storeRepository
    ) {}

    public function store(array $data) {
        // return $this->storeRepository->store($data);
    }

    public function update(array $data, $id)
    {
        // return $this->storeRepository->update($data, $id);
    }

}