<?php

namespace App\Traits;

use App\Models\Warehouse\StockItem;

trait AddItemToSale
{
    use ReturnItemStatusInfo;

    
    public function addItemToSale($itemId, $storeId, $sale)
    {
        $this->validateItem($itemId, $storeId, $sale);
    }

    private function validateItem($itemId, $storeId, $sale)
    {
        $item = StockItem::find($itemId);

        if (!$item) {
            $this->addError('add-item', 'Item not found');
            return;
        }

        if ($item->store_id !== $storeId) {
            $this->addError('add-item', $this->returnItemStatusInfo($itemId));
            return;
        }

        if ($item->status !== StockItem::AVAILABLE) {
            if($item->sale_id === $sale->id) {
                $this->addError('add-item', "This item is already added to this sale.");
                return;
            } else {
                $this->addError('add-item', $this->returnItemStatusInfo($itemId));
                return;
            }
        }

    }

}
