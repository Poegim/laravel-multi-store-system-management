<?php

namespace App\View\Components;

use App\Traits\GetToken;
use Closure;
use Illuminate\View\Component;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;

class SearchMultiselectDropdown extends Component
{
    use GetToken;

    public function __construct(
        public Collection $collection,
        public string $inputName,
        public $passedId = null,
        public string $searchBy = 'name',
        ) {
        }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $token = $this->getToken();

        return view('components.search-multiselect-dropdown', [
            'collection' => $this->collection,
            'inputName' => $this->inputName,
            'searchBy' => $this->searchBy,
            'passedId' => $this->passedId,
            'token' => $token,
        ]);
    }
}
