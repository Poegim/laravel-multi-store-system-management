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
    public $selectedDevices = [];
    public $hiddenDevices;

    public function updatedSearch()
    {
        $this->modelsListVisibility = !empty($this->search);
    }

    public function handleDeviceSelect($param)
    {
        if (($key = array_search($param, $this->selectedDevices)) !== false) {
            unset($this->selectedDevices[$key]);
        } else {
            $this->selectedDevices[] = $param;
        }

        $this->hiddenDevices = Product::devices()->
        whereIn ('id', $this->selectedDevices)->
        get();

    }

    public function render()
    {
        $products = Product::select('id', 'name')->where('is_device', false)->get();

        $devices =
            Product::devices()->
                where('name', 'like', '%' . $this->search . '%')->
                whereNotIn ('id', $this->selectedDevices)->
                get();

        $features = Feature::select(['id', 'name'])->orderBy('name', 'asc')->get();

        return view('livewire.warehouse.product-variant.create-product-variant', [
            'products' => $products,
            'devices' => $devices,
            'features' => $features,
        ]);
    }
}
