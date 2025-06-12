<?php

namespace App\Livewire\Warehouse\StockItem;

use App\Models\Store;
use App\Models\Warehouse\StockItem;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Traits\Searchable;

class IndexStockItems extends Component
{
    use Searchable;
    use Sortable;
    use WithPagination;

    public $store;
    public int $perPage = 10;

    public function mount($store = null)
    {
        $this->store = $store;
    }
    
    public function render()
    {   
        if($this->store) {
            $stockItems = StockItem::when($this->store?->id, function ($query, $storeId) {
            return $query->where('store_id', $storeId);
            })->with(['productVariant.product.brand', 'vatRate', 'brand'])->paginate($this->perPage);
        } else {
            $stockItems = StockItem::with(['productVariant.product.brand', 'vatRate', 'brand'])
                ->paginate($this->perPage);
        }
        return view('livewire.warehouse.stock-item.index-stock-items', compact('stockItems'));
    }
}
