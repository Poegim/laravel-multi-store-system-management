<?php

namespace App\Repositories\FeatureRepository ;

use App\Models\Warehouse\Feature;

interface FeatureRepositoryInterface
{
    public function store(array $data);
    public function update(array $data, Feature $feature);
}