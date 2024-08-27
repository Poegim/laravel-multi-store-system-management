<?php

namespace App\Repositories\CategoryRepository ;

interface CategoryRepositoryInterface
{
    public function store(array $data);
    public function update(array $data, int $id);
    public function activeTree($excludeChildOf);
    public function allTree($excludeChildOf);
}
