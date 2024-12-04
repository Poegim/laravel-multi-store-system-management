<?php

namespace App\Repositories\BrandRepository ;

use Illuminate\Support\Carbon;
use App\Models\Warehouse\Brand;

class BrandRepository implements BrandRepositoryInterface
{
    public function store(array $data)
    {
        $brand = new Brand;
        $brand = $this->associate($brand, $data);
        $brand->user_id = auth()->user()->id;
        $brand->created_at = Carbon::now()->format('Y-m-d H:i:s');
        return $brand->save();
    }
    
    public function update(array $data, Brand $brand)
    {
        $brand = $this->associate($brand, $data);
        $brand->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        return $brand->save();
    }

    private function associate(Brand $brand, array $data)
    {
        $brand->name = $data['name'];
        $brand->slug = $data['slug'];
        return $brand;
    }

}
