<?php

namespace App\Repositories\BrandRepository ;

use App\Models\Warehouse\Brand;

interface BrandRepositoryInterface
{
    public function store(array $data);
    public function update(array $data, int $id);
}