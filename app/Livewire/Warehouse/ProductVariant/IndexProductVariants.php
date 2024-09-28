<?php

namespace App\Livewire\Warehouse\ProductVariant;

use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\Searchable;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\Warehouse\ProductVariant;

class IndexProductVariants extends Component
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

        ->withCount('stockItems')
        ->orderBy($this->sortField, $sortDirection)
        ->paginate(10);

        return view('livewire.warehouse.product-variant.index-product-variants', [
            'productVariants' => $productsVariants,
            'products' => DB::table('products')->select('id', 'name')->get(),
        ]);
    }
}
