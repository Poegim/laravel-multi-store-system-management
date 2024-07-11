<?php

namespace App\Repositories\CategoryRepository ;

use App\Models\Warehouse\Category;

interface CategoryRepositoryInterface
{
    public function store(array $data);
    public function update(array $data, int $id);
}