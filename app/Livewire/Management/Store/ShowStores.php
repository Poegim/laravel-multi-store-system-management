<?php

namespace App\Livewire\Management\Store;

use App\Models\Store;
use Livewire\Component;

class ShowStores extends Component
{    
    public function render()
    {
        return view('livewire.management.store.show-stores', [
            'stores' => Store::with('color')->get(),
        ]);
    }
}
