<?php

namespace App\Livewire\Commerce\ExternalInvoice;

use App\Models\Color;
use Livewire\Component;
use App\Models\Warehouse\Brand;
use App\Models\Warehouse\Product;
use App\Models\Commerce\ExternalInvoice;

class EditExternalInvoiceItems extends Component
{
    public $colors;
    public $searchColor = '';
    public $color;
    public $decodedColor;

    public $brands;
    public $products;
    public $productVariants;
    public $devices;

    public $brand;
    public $product;
    public $variant;
    public $device;

    public $searchProduct = '';
    public $searchDevice = '';
    
    public $selectedProduct;
    public $selectedDevice;

    public $lockBrand = false;
    
    public ?ExternalInvoice $externalInvoice = null;
    
    // public $visibleList = false;
    // public $collection;
    // public $searchBy = 'name';

    public function mount(ExternalInvoice $externalInvoice) {
        $this->externalInvoice = $externalInvoice;
        $this->brands = Brand::select('id', 'name')->get();
        $this->products = Product::select('id', 'name')->limit(100)->get();
        $this->devices = Product::devices()->select('id', 'name')->limit(100)->get();
        $this->colors = Color::all();
    }

    public function updatedSearchProduct()
    {
        $this->products = Product::select('id', 'name')->where('name', 'like', '%'.$this->searchProduct.'%')->limit(500)->get();
    }

    public function updatedSearchDevice()
    {
        $this->devices = Product::select('id', 'name')->devices()->where('name', 'like', '%'.$this->searchDevice.'%')->limit(100)->get();
    }

    public function updatedSearchColor()
    {
        $this->colors = Color::where('name', 'like', '%'.$this->searchColor.'%')->get();
    }

    public function updatedColor($value)
    {
        $this->decodedColor = json_decode($value);
    }

    public function selectProduct($id)
    {
        $this->selectedProduct = $id;
        $this->searchProduct = $this->products->firstWhere('id', $id)->name;
        $this->product = Product::findOrFail($id);
        $this->productVariants = $this->product->productVariants;
        if($this->product->is_device) {
            $this->brand = $this->product->brand->id;
            $this->lockBrand = true;
        } else {
            $this->lockBrand = false;
        }
    }

    public function selectDevice($id)
    {
        $this->selectedDevice = $id;
        $this->searchDevice = $this->devices->firstWhere('id', $id)->name;
        $this->device = Product::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.commerce.external-invoice.edit-external-invoice-items');
    }
}
