<?php

namespace App\Traits;

trait Searchable
{
    public $search = '';
    public $searchBy = 'name';

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
