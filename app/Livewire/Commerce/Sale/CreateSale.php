<?php

namespace App\Livewire\Commerce\Sale;

use App\Models\Commerce\Sale;
use App\Models\Store;
use App\Models\Warehouse\StockItem;
use Livewire\Component;

class CreateSale extends Component
{
    public Store $store;
    public ?Sale $sale;
    public $searchItem = '';

    public function mount(Store $store, ?Sale $sale = null)
    {
        $this->store = $store;
        $this->sale = $sale;
    }

    public function addItem()
    {
        $item = StockItem::available()
            ->where('store_id', $this->store->id)
            ->where('id', $this->searchItem)
            ->first();

        if ($item) {
            $this->sale->items()->attach($item->id);
        } else {
            $this->searchItem = '';
            $this->addError('searchItem', 'Item not found!');
        }
    }

    public function render()
    {
        return view('livewire.commerce.sale.create-sale');
    }
}
