<?php

namespace App\Livewire\Warehouse\ProductVariant;

use App\Models\Warehouse\ProductVariant;
use App\Traits\Searchable;
use App\Traits\Sortable;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProductVariants extends Component
{
    use Sortable;
    use Searchable;
    use WithPagination;

    public function resetSearch()
    {
        $this->searchBy = 'name';
        $this->sortAsc = false;
        $this->search = '';
        $this->resetPage();
    }

    public function render()
    {
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';

        $productsVariants = ProductVariant::with('product')
        ->when($this->searchBy === 'name', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->when($this->searchBy === 'ean', function ($query) {
            $query->where('ean', 'like', '%' . $this->search . '%');
        })
        ->when($this->searchBy === 'product.name', function ($query) {
            $query->whereHas('product', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        })
        
        ->orderBy($this->sortField, $sortDirection)
        ->paginate(10);
        
        return view('livewire.warehouse.product-variant.show-product-variants', [
            'productVariants' => $productsVariants,
        ]);
    }
}
