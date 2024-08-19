<?php

namespace App\Traits;

trait Sortable
{
    public $sortField ='id';
    public $sortAsc = true;

    public function sortBy($field) {
        if($field == $this->sortField) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortField = $field;
        }
    }
}