<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SearchDropdown extends Component
{
    
    /**
     * AT THIS MOMENT THIS COMPONENT SHOULDNT BE USE IN LIVEWIRE COMPONENTS, 
     * IT IS UNABLE TO RESET SEARCH STATE.
     * 
     */

    /**
     * In case of use this component inside a Livewire Component add JS listener to parent view.
     * That will set your Livewire property to selected item id.
     * 
     *     @script
     *      <script>
     *          $wire.on('searchDropdownChange', (data) => {
     *              @this[data['uniqueId']] = data['value'];
     *          });
     *      </script>
     *      @endscript
     */

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
        return view('components.search-dropdown', [
            'collection' => $this->collection,
            'inputName' => $this->inputName,
            'searchBy' => $this->searchBy,
            'passedId' => $this->passedId,
        ]);
    }
}
