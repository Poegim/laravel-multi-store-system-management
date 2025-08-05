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
    public $editedItem = null;
    public  bool $editSoldPriceModal = false;

    public function mount(Store $store, Sale $sale)
    {
        $this->store = $store;
        $this->sale = $sale;
        foreach ($this->sale->items as $item) {
            $item->sold_price = $item->suggested_retail_price; // Initialize sold_price with suggested_retail_price
        }
    }

    public function editSoldPrice(StockItem $item)
    {
        $this->editedItem = $item;
        $this->editSoldPriceModal = true;
    }

    public function updateSoldPrice()
    {
        dd($this->editedItem->suggested_retail_price);

        $this->validate([
            'editedItem.suggested_retail_price' => 'required|numeric|min:0.01|max:100000',
        ]);

        $this->editedItem->sold_price = $this->decimalToInteger(round((float) $this->editedItem->suggested_retail_price, 2));

        $this->editedItem->save();
        $this->editSoldPriceModal = false;
        $this->dispatch('sold-price-updated');
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

    public function removeItem(StockItem $item)
    {
        if($item->status !== StockItem::AVAILABLE) {
            $this->addError('searchItem', 'This item is not available for removal.');
            return;
        } else {

            $item->sale_id = null;
            $item->save();
            $this->sale->refresh();
        }
    }    

    public function render()
    {
        return view('livewire.commerce.sale.create-sale', [
            'saleItems' => $this->sale->items()->with(['brand', 'productVariant.product'])->get(),
        ]);
    }
}
