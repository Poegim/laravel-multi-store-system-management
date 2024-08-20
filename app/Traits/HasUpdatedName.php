<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUpdatedName
{
    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }
}
