<?php

namespace App\Repositories\StoreRepository;

interface StoreRepositoryInterface
{
    public function store(array $data);
    public function update(array $data, int $id);
}