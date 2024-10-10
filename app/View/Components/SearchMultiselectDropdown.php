<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;

class SearchMultiselectDropdown extends Component
{
    public $token;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Collection $collection, 
        public string $inputName,
        public $passedId = null,
        public string $searchBy = 'name',
        ) {
            $user = auth()->user();
            if ($user) {
                $this->token = $user->currentAccessToken() ? $user->currentAccessToken()->token : null; // Pobieranie tokena
            } else {
                $this->token = null; // Obsługa przypadku, gdy użytkownik nie jest zalogowany
            }
        }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        dd($this->token);

        return view('components.search-multiselect-dropdown', [
            'collection' => $this->collection,
            'inputName' => $this->inputName,
            'searchBy' => $this->searchBy,
            'passedId' => $this->passedId,
            'token' => $this->token,
        ]);
    }
}
