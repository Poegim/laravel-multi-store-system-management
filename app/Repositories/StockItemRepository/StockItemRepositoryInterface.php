<?php

namespace App\Repositories\StockItemRepository;

use App\Models\Store;
use App\Models\Warehouse\StockItem;

interface StockItemRepositoryInterface
{
    public function assignToSale(StockItem $stockItem, Store $store): bool;
    public function removeFromSale(StockItem $stockItem): bool;
    public function markAsSold(StockItem $stockItem, Store $store): bool;
}