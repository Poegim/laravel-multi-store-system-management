<?php

namespace App\Livewire\Management\Store;

use App\Models\Store;
use Livewire\Component;

class ShowStores extends Component
{

    public bool $showEditModal = false;
    public ?Store $store;
   
    public function mount() 
    {
        //
    }

    public function edit(int $id)
    {
        $this->store = Store::findOrFail($id);
        $this->showEditModal = true;
    }

    public function update(int $id)
    {
        //
    }

    protected function updateUser(int $id)
    {
        //
    }
    
    public function render()
    {
        return view('livewire.management.store.show-stores', [
            'stores' => Store::all(),
        ]);
    }
}
