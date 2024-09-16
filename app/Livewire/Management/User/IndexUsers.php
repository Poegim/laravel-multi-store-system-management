<?php

namespace App\Livewire\Management\User;

use App\Models\User;
use Livewire\Component;

class IndexUsers extends Component
{

    public bool $showEditModal = false;
    public ?User $user;

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
   
    public function mount() 
    {
        //
    }

    public function edit(int $id)
    {
        $this->user = User::findOrFail($id);
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
        return view('livewire.management.user.index-users', [
            'users' => User::all()->except(1),
        ]);
    }
}
