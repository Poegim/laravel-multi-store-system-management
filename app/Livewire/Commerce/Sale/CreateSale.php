<?php

namespace App\Livewire\Commerce\Sale;

use App\Models\Store;
use Livewire\Component;
use App\Models\Commerce\Sale;
use Illuminate\Validation\Rule;
use App\Models\Warehouse\StockItem;
use Illuminate\Support\Facades\Log;

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

        $this->validate(
            [
                'searchItem' => [
                    'required',
                    'numeric',
                    Rule::exists('stock_items', 'id')->where(function ($query) {
                        $query->where('store_id', $this->store->id);
                    }),
                ],
            ],
            [
                'searchItem.exists' => 'This item does not exist in the selected store.',
            ]
        );


        $item = StockItem::available()
            ->where('store_id', $this->store->id)
            ->where('id', $this->searchItem)
            ->first();

        if ($item) {
            $this->resetErrorBag();
            dd($item);
            $this->sale->items()->attach($item->id);
        } else {
            Log::error('Item not found in the selected store', [
                'store_id' => $this->store->id,
                'item_id' => $this->searchItem,
            ]);
            abort(404, 'Item not found in the selected store, contact support.');
        }
    }

    public function render()
    {
        return view('livewire.commerce.sale.create-sale');
    }
}
