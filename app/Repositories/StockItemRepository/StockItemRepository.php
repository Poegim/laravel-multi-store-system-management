<?php 

namespace App\Repositories\StockItemRepository;

use App\Models\Store;
use App\Models\Warehouse\StockItem;

class StockItemRepository implements StockItemRepositoryInterface
{
    public function assignToSale(StockItem $stockItem, Store $store): bool
    {
        $stockItem->store_id = $store->id;
        $stockItem->status = StockItem::IN_PENDING_SALE;
        return $stockItem->save();
    }

    public function removeFromSale(StockItem $stockItem): bool
    {
        $stockItem->store_id = null;
        $stockItem->status = StockItem::AVAILABLE;
        return $stockItem->save();
    }

    public function markAsSold(StockItem $stockItem, Store $store): bool
    {
        $stockItem->store_id = $store->id;
        $stockItem->status = StockItem::SOLD;
        $stockItem->sold_at = now();
        return $stockItem->save();
    }
}
