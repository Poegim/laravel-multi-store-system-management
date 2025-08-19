<?php

namespace App\Services;

use App\Models\Store;
use App\Models\Commerce\Sale;
use Illuminate\Support\Facades\DB;
use App\Models\Warehouse\StockItem;
use App\Repositories\StockItemRepository\StockItemRepositoryInterface;

class StockItemService
{
    public function __construct(
        protected StockItemRepositoryInterface $stockItemRepository
    ) {}

    public function assignToSale(StockItem $stockItem, Sale $sale): bool
    {
        return DB::transaction(function () use ($stockItem, $sale) {
            $stockItem->status = StockItem::IN_PENDING_SALE;
            $stockItem->save();

            $sale->stockItems()->attach($stockItem->id, [
                'price' => $stockItem->suggestedRetailPrice(),
            ]);

            return true;
        });
    }

    public function removeFromSale(StockItem $stockItem, Sale $sale): bool
    {
        return DB::transaction(function () use ($stockItem, $sale) {
            $sale->stockItems()->detach($stockItem->id);

            $stockItem->status = StockItem::AVAILABLE;
            $stockItem->save();

            return true;
        });
    }

    public function markAsSold(StockItem $stockItem, Store $store): bool
    {
        $stockItem->status = StockItem::SOLD;
        $stockItem->sold_at = now();
        $stockItem->store_id = $store->id; // jeśli chcesz zapisać, w którym sklepie sprzedano
        return $stockItem->save();
    }

}