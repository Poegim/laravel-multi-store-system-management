<?php

namespace App\Livewire\Warehouse\Brand;

use App\Models\Warehouse\Brand;
use App\Traits\Sortable;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;


class ShowBrands extends Component
{
    use WithPagination;
    use Sortable;

    public $search = '';

    #[On('updated')]
    public function refresh()
    {
    }

    public function render()
    {
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';

        $brands = Brand::where('name', 'like', '%'.$this->search.'%')
                    ->orderBy($this->sortField, $sortDirection)
                    ->paginate(10);

        return view('livewire.warehouse.brand.show-brands', compact('brands'));
    }
}
