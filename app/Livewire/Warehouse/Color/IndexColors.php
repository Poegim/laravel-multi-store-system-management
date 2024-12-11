<?php

namespace App\Livewire\Warehouse\Color;

use App\Models\Color;
use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\Searchable;
use Livewire\WithPagination;

class IndexColors extends Component
{
    use Searchable;
    use Sortable;
    use WithPagination;

    public function render()
    {
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';

        $colors = 
            Color::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('value', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $sortDirection)
            ->paginate(10);

            return view('livewire.warehouse.color.index-colors', compact('colors'));
        }

}
