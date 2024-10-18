<?php

namespace App\Livewire\Warehouse\ProductVariant;

use Livewire\Component;
use App\Models\Warehouse\Feature;
use App\Models\Warehouse\Product;
use Illuminate\Support\Collection;

class CreateProductVariant extends Component
{
    
    // public string $name = '';
    // public array $selectedDevices = [];
    // public string $search = '';
    // public bool $modelsListVisibility = false;
    // public bool $automatedName = true;

    // public ?Collection $hiddenDevices;

    // public function updatedSearch()
    // {
    //     $this->modelsListVisibility = !empty($this->search);
    // }

    // public function handleDeviceSelect($param)
    // {
    //     if (($key = array_search($param, $this->selectedDevices)) !== false) {
    //         unset($this->selectedDevices[$key]);
    //     } else {
    //         $this->selectedDevices[] = $param;
    //     }

    //     $this->hiddenDevices = Product::devices()->
    //     whereIn ('id', $this->selectedDevices)->
    //     get();

    //     $this->generateName();

    // }

    // public function generateName()
    // {
    //     if($this->automatedName)
    //     {
    //         $this->name = '';
    //         foreach($this->hiddenDevices as $device)
    //         {
    //             $this->name = $this->name . ' ' . $device->name;
    //         }
    //     }
    // }

    public function render()
    {
        $products = Product::select('id', 'name')->where('is_device', false)->get();
        $devices = Product::devices()->get();
        $features = Feature::select(['id', 'name'])->orderBy('name', 'asc')->get();

        return view('livewire.warehouse.product-variant.create-product-variant', [
            'products' => $products,
            'devices' => $devices,
            'features' => $features,
        ]);
    }
}
