<?php

namespace App\Traits;

use App\Models\Store;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToStore
{
    public function store(): BelongsTo {
        return $this->belongsTo(Store::class);
    }
}
