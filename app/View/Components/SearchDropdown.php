<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SearchDropdown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Collection $collection, 
        public string $inputName,
        public string $searchBy = 'name'
        ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-dropdown', [
            'collection' => $this->collection,
            'inputName' => $this->inputName,
            'searchBy' => $this->searchBy,
        ]);
    }
}
