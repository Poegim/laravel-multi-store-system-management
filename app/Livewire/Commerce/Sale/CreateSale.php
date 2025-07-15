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
    

    public function mount(Store $store, Sale $sale)
    {
        $this->store = $store;
        $this->sale = $sale; 
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
            ->where(function ($query) {
                $query->whereNull('sale_id')
                      ->orWhere('sale_id', $this->sale->id);
            })
        ->first();
        
        if ($item) {
            if ($this->sale->items->contains($item->id)) {
            $this->addError('searchItem', "This item is already added to the on-going sale id:{$item->sale->id} of user {$item->sale->user->name}.");
            } else {
                $this->resetErrorBag();
                $this->sale->items()->save($item);
                $this->searchItem = '';
                $this->dispatch('item-added');
            }
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
        return view('livewire.commerce.sale.create-sale', [
            'saleItems' => $this->sale->items()->get(),
        ]);
    }
}
