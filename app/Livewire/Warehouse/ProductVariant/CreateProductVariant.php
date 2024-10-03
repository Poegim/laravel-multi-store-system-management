<?php

namespace App\Livewire\Warehouse\ProductVariant;

use Livewire\Component;
use App\Models\Warehouse\Feature;
use App\Models\Warehouse\Product;

/**
 * CreateProductVariant class
 * @param Callection $products
 */
class CreateProductVariant extends Component
{
    public $search = '';
    public $modelsListVisibility = false;

    public function updatedSearch()
    {
        $this->modelsListVisibility = !empty($this->search);
    }

    public function render()
    {
        $products = Product::select('id', 'name')->where('is_device', false)->get();
        $devices = Product::devices()->where('name', 'like', '%' . $this->search . '%')->get();
        $features = Feature::select(['id', 'name'])->orderBy('name', 'asc')->get();

        return view('livewire.warehouse.product-variant.create-product-variant', [
            'products' => $products,
            'devices' => $devices,
            'features' => $features,
        ]);
    }
}
