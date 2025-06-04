<?php

namespace App\Livewire\Warehouse\StockItem;

use App\Models\Store;
use App\Models\Warehouse\StockItem;
use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\Searchable;
use Livewire\WithPagination;

class IndexStockItems extends Component
{
    use Searchable;
    use Sortable;
    use WithPagination;

    public ?Store $store;

    public function mount(?Store $store = null)
    {
        $this->store = $store;
    }
    
    public function render()
    {
        $stockItems = StockItem::when($this->store?->id, function ($query, $storeId) {
            return $query->where('store_id', $storeId);
            })->get();
            
        return view('livewire.warehouse.stock-item.index-stock-items', compact('stockItems'));
    }
}
