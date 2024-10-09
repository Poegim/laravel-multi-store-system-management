<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;

class SearchMultiselectDropdown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Collection $collection, 
        public string $inputName,
        public $passedId = null,
        public string $searchBy = 'name',
        ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-multiselect-dropdown', [
            'collection' => $this->collection,
            'inputName' => $this->inputName,
            'searchBy' => $this->searchBy,
            'passedId' => $this->passedId,
        ]);
    }
}
