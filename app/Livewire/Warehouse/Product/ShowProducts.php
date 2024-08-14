<?php

namespace App\Livewire\Warehouse\Product;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Warehouse\Product;
use App\Traits\Sortable;

class ShowProducts extends Component
{

    use WithPagination;
    use Sortable;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';
        $products = Product::with(['category', 'brand'])->where('name', 'like', '%'.$this->search.'%')
                        ->orderBy($this->sortField, $sortDirection)
                        ->paginate(10);
                        
        return view('livewire.warehouse.product.show-products', compact('products'));
    }
}
