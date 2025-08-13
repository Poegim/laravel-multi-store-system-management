<?php

namespace App\Services;

use App\Models\Store;
use App\Models\Warehouse\StockItem;
use App\Repositories\StockItemRepository\StockItemRepositoryInterface;

class StockItemService
{
    public function __construct(
        protected StockItemRepositoryInterface $stockItemRepository
    ) {}

    public function assignToSale(StockItem $stockItem, int $saleId): bool
    {
        $stockItem->status = StockItem::IN_PENDING_SALE;
        $stockItem->sale_id = $saleId;
        return $stockItem->save();
    }

    public function removeFromSale(StockItem $stockItem): bool
    {
        $stockItem->sale_id = null;
        $stockItem->status = StockItem::AVAILABLE;
        return $stockItem->save();
    }

    public function markAsSold(StockItem $stockItem, Store $store): bool
    {
        $stockItem->status = StockItem::SOLD;
        $stockItem->sold_at = now();
        return $stockItem->save();
    }

}