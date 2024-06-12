<?php

namespace App\Repositories\StoreRepository;

interface StoreRepositoryInterface
{
    public function update(array $data, int $id);
}