<?php

namespace App\Repositories\BrandRepository ;

use App\Models\Warehouse\Brand;

class BrandRepository implements BrandRepositoryInterface
{
    public function store(array $data)
    {
        $brand = new Brand;
        $brand = $this->associate($brand, $data);
        $brand->user_id = auth()->user()->id;
        return $brand->save();
    }

    public function update(array $data, Brand $brand)
    {
        $brand = $this->associate($brand, $data);
        return $brand->save();
    }

    private function associate(Brand $brand, array $data)
    {
        $brand->name = $data['name'];
        $brand->slug = $data['slug'];
        return $brand;
    }

}
