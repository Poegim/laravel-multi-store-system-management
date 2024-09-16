<?php

namespace App\Livewire\Warehouse\Feature;

use App\Models\Warehouse\Feature;
use App\Traits\Searchable;
use App\Traits\Sortable;
use Livewire\Component;
use Livewire\WithPagination;

class IndexFeatures extends Component
{
    use Searchable;
    use Sortable;
    use WithPagination;

    public function render()
    {
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';

        $features = Feature::where('name', 'like', '%'.$this->search.'%')
                    ->orderBy($this->sortField, $sortDirection)
                    ->paginate(10);

        return view('livewire.warehouse.feature.index-features', compact('features'));
    }
}
