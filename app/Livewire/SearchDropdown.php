<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class SearchDropdown extends Component
{
    #[Modelable] 
    public $selectedItem;

    public $search = '';
    public $collection;
    public $searchBy;
    public $searched;
    public $selected_id;

    public function mount($collection, $selected_id = null, $searchBy = 'name')
    {
        $this->collection = $collection;
        if($selected_id) {
            $this->selectedItem = $selected_id;
        }
        $this->searchBy = $searchBy;
        $this->searched = $collection;
    }

    public function updatedSearch()
    {
        if (is_null($this->collection)) {
            $this->searched = collect();
            return;
        }

        $this->searched = $this->collection->filter(function ($item) {
            return stripos($item->{$this->searchBy}, $this->search) !== false;
        });
    }

    public function selectItem($id)
    {
        $this->selectedItem = $id;
        $this->search = $this->collection->firstWhere('id', $id)->name;
    }

    public function render()
    {
        return view('livewire.search-dropdown');
    }

}
