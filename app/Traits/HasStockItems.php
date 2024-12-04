<?php

namespace App\Traits;

use App\Models\Warehouse\StockItem;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasStockItems
{
    public function stockItems(): HasMany
    {
        return $this->hasMany(StockItem::class);
    }
}
