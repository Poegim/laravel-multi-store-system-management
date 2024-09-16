<?php

namespace App\Livewire\Management\Store;

use App\Models\Store;
use Livewire\Component;

class IndexStores extends Component
{    
    public function render()
    {
        return view('livewire.management.store.index-stores', [
            'stores' => Store::with('color')->get(),
        ]);
    }
}
