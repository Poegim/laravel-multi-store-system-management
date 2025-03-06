<?php

namespace App\Traits;

use App\Models\Warehouse\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToDevice
{
    public function device(): BelongsTo {
        return $this->belongsTo(Product::class, 'device_id');
    }
}
