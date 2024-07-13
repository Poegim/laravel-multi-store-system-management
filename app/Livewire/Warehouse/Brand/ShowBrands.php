<?php

namespace App\Livewire\Warehouse\Brand;

use App\Models\Warehouse\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class ShowBrands extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $brands = Brand::where('name', 'like', '%'.$this->search.'%')->paginate(25);
        return view('livewire.warehouse.brand.show-brands', compact('brands'));
    }
}
