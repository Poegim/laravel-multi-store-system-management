<?php

namespace App\Livewire\Commerce\ExternalInvoice;

use Livewire\Component;
use App\Models\Warehouse\Brand;
use App\Models\Warehouse\Product;
use App\Models\Commerce\ExternalInvoice;

class EditExternalInvoiceItems extends Component
{
    public $brands;
    public $products;
    public $productVariants;

    public $brand;
    public $product;
    public $variant;

    public $search = '';
    public $collection;
    public $searchBy = 'name';
    public $visibleList = false;

    public $selectedProduct;

    public ?ExternalInvoice $externalInvoice = null;

    public function mount(ExternalInvoice $externalInvoice) {
        $this->externalInvoice = $externalInvoice;
        $this->brands = Brand::select('id', 'name')->get();
        $this->products = Product::select('id', 'name')->limit(100)->get();
    }

    public function updatedSearch()
    {
        $this->products = Product::select('id', 'name')->where('name', 'like', '%'.$this->search.'%')->limit(500)->get();
    }

    public function selectProduct($id)
    {
        $this->selectedProduct = $id;
        $this->search = $this->products->firstWhere('id', $id)->name;
        $this->product = Product::findOrFail($id);
        $this->productVariants = $this->product->productVariants;
    }

    public function render()
    {
        return view('livewire.commerce.external-invoice.edit-external-invoice-items');
    }
}
