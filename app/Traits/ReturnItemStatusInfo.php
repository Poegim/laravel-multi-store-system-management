<?php

namespace App\Traits;

use App\Models\Commerce\Sale;
use App\Models\Warehouse\StockItem;

trait ReturnItemStatusInfo
{
    public function returnItemStatusInfo(int $id): string
    {
        $item = StockItem::find($id);
        if (!$item) {
            return 'Item not found';
        }

        switch ($item->status) {
            case StockItem::AVAILABLE:
                return 'Available';

            case StockItem::SOLD:
                    $sale = $item->lastSale();

                    if ($sale) {
                        $pivot = $sale->stockItems()->where('stock_item_id', $item->id)->first()->pivot;
                        $soldAt = $pivot->sold_at ?? 'unknown';
                        $userName = $sale->user?->name ?? 'unknown';
                        $storeName = $sale->store?->name ?? 'unknown';

                        return "Sold at: {$soldAt} by {$userName} at store {$storeName}";
                    }

            case StockItem::MISSING:
                return 'Missing';

            case StockItem::IN_PENDING_SALE:
                // np. bieżąca sprzedaż zalogowanego użytkownika
                $pendingSale = $item->sales()->where('status', Sale::PENDING)->latest('pivot_created_at')->first();
                if ($pendingSale) {
                    return 'Currently in Pending Sale (Sale ID: ' . $pendingSale->id . ') by '
                        . $pendingSale->user->name . ' at store ' . $item->store->name;
                }
                return 'Currently in Pending Sale';

            case StockItem::IN_REPAIR:
                return 'In Repair at store ' . $item->store->name;

            case StockItem::IN_TRANSFER:
                return 'In Transfer at store ' . $item->store->name;

            default:
                return 'Unknown Status';
        }
    }

}
