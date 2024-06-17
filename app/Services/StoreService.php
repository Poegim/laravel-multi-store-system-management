<?php

namespace App\Services;

use App\Repositories\StoreRepository\StoreRepositoryInterface;


class StoreService
{
    public function __construct(
        protected StoreRepositoryInterface $storeRepository
    ) {}

    public function store(array $data) {
        return $this->storeRepository->store($data);
    }

    public function update(array $data, $id)
    {
        return $this->storeRepository->update($data, $id);
    }

}