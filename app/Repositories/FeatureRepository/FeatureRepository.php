<?php

namespace App\Repositories\FeatureRepository ;

use App\Models\Warehouse\Feature;
use App\Repositories\FeatureRepository\FeatureRepositoryInterface;

class FeatureRepository implements FeatureRepositoryInterface
{
    public function store(array $data)
    {
        $feature = new Feature;
        $feature = $this->associate($feature, $data);
        $feature->user_id = auth()->user()->id;
        return $feature->save();
    }

    public function update(array $data, Feature $feature)
    {
        $feature = $this->associate($feature, $data);
        return $feature->save();
    }

    private function associate(Feature $feature, array $data)
    {
        $feature->name = $data['name'];
        $feature->short_name = $data['short_name'];
        $feature->slug = $data['slug'];
        return $feature;
    }

}
