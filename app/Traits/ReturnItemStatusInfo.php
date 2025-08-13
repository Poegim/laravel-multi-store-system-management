<?php

namespace App\Traits;

use App\Models\Warehouse\StockItem;

trait ReturnItemStatusInfo
{
    public function returnItemStatusInfo(int $id): string
    {
        $status = '';

        $item = StockItem::findOrFail($id);
        if (!$item) {
            return 'Item not found';
        } else {
            switch ($item->status) {
                case StockItem::AVAILABLE:
                    $status = 'Available';
                    break;
                case StockItem::SOLD:
                    $status = 'Sold at store ' . $item->store->name . ' on ' . $item->sale->sold_at->format('Y-m-d H:i:s') . ' by ' . $item->sale->user->name;
                    break;
                case StockItem::MISSING:
                    $status = 'Missing';
                    break;
                case StockItem::IN_PENDING_SALE:
                    $status = 'In Pending Sale' . ' (Sale ID: ' . $item->sale->id . ')' . ' by ' . $item->sale->user->name . ' at store ' . $item->store->name;
                    break;
                case StockItem::IN_REPAIR:
                    $status = 'In Repair' . ' at store ' . $item->store->name;
                    break;
                case StockItem::IN_TRANSFER:
                    $status = 'In Transfer' . ' at store ' . $item->store->name;
                    break;
                default:
                    $status = 'Unknown Status';
            }
        }

        return $status;
    }
}
