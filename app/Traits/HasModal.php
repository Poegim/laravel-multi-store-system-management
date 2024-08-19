<?php

namespace App\Traits;

trait HasModal
{
    public bool $modalVisibility = false;
    public string $actionType = '';
    
    public function showModal(string $actionType)
    {
        $this->actionType = $actionType;
        $this->modalVisibility = true;
        $this->dispatch('modalVisibility');
    }
}
