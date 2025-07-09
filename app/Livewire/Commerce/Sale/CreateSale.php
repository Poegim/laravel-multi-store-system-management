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
        $sale ? $this->sale = $sale : $this->sale = new Sale();
        if($this->sale->store_id) {
            if($this->sale->store_id != $this->store->id) {
                abort(403, 'Unauthorized action, this sale does not belong to the selected store.');
            }
        } else {
            $this->sale->store_id = $this->store->id;
        }
    }

    public function addItem()
    {
        $this->validate([
            'searchItem' => 'required|numeric|exists:stock_items,id',
        ]);

        $item = StockItem::available()
            ->where('store_id', $this->store->id)
            ->where('id', $this->searchItem)
            ->first();

        if ($item) {
            $this->resetErrorBag();
            dd($item);
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
