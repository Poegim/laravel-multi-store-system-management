<?php

namespace App\Livewire\Commerce\ExternalInvoice;

use App\Models\Color;
use Livewire\Component;
use App\Models\Warehouse\Brand;
use App\Models\Warehouse\Product;
use Illuminate\Support\Collection;
use App\Models\Commerce\ExternalInvoice;

class EditExternalInvoiceItems extends Component
{
    public ?Collection $colors;
    public ?Collection $vatRates;
    public $searchColor = '';
    public $color;

    public $brands;
    public $products;
    public $productVariants;
    public $devices;

    //Start of properties
    public ?int $brand;
    public ?Product $product;
    public ?int $variant;
    public ?Product $device;
    public $srp;
    public ?string $imei_number;
    public ?int $quantity;
    public $net_buy_price;
    //End of properties

    public $searchProduct = '';
    public $searchDevice = '';

    public $selectedProduct;
    public $selectedDevice;

    public $lockBrand = false;
    public $lockQuantity = false;

    public ?ExternalInvoice $externalInvoice = null;

    public function mount(ExternalInvoice $externalInvoice) {
        $this->externalInvoice = $externalInvoice;
        $this->brands = Brand::select('id', 'name')->get();
        $this->products = Product::select('id', 'name')->limit(100)->get();
        $this->devices = Product::devices()->select('id', 'name')->limit(100)->get();
        $this->colors = Color::all();
        $this->srp = 0;
        $this->imei_number = '';
        $this->quantity = 0;
        $this->net_buy_price = 0;
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

    public function updatedProduct()
    {
        if($this->product->is_device) {
            $this->brand = $this->product->brand->id;
            $this->lockBrand = true;
            $this->lockQuantity = true;
            $this->quantity = 1;
        } else {
            $this->lockBrand = false;
        }
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function selectProduct($id)
    {
        $this->selectedProduct = $id;
        $this->searchProduct = $this->products->firstWhere('id', $id)->name;
        $this->product = Product::findOrFail($id);
        $this->productVariants = $this->product->productVariants;
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
