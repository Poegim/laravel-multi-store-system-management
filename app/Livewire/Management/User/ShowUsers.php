<?php

namespace App\Livewire\Management\User;

use App\Models\User;
use Livewire\Component;

class ShowUsers extends Component
{

    public bool $showUserModal = false;
    public ?User $user;
   
    public function mount() 
    {
        //
    }

    public function edit(int $id)
    {
        $this->user = User::findOrFail($id);
        $this->showUserModal = true;
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
        return view('livewire.management.user.show-users', [
            'users' => User::all()->except(1),
        ]);
    }
}
