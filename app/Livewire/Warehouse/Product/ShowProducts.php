<?php

namespace App\Livewire\Warehouse\Product;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Warehouse\Product;

class ShowProducts extends Component
{

    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::with(['category', 'brand'])->where('name', 'like', '%'.$this->search.'%')->paginate(10);
        return view('livewire.warehouse.product.show-products', compact('products'));
    }
}
