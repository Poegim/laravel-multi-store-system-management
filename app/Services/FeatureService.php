<?php

namespace App\Services;

use App\Models\Warehouse\Feature;
use App\Repositories\FeatureRepository\FeatureRepositoryInterface;

class FeatureService
{
    public function __construct(
        protected FeatureRepositoryInterface $featureRepository
    ) {}

    public function store(array $data) {
        return $this->featureRepository->store($data);
    }

    public function update(array $data, Feature $feature)
    {
        return $this->featureRepository->update($data, $feature);
    }

}