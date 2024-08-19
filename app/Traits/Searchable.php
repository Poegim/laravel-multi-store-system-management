<?php

namespace App\Traits;

trait Searchable
{
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
