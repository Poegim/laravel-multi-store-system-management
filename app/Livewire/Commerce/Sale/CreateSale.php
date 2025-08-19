<?php

namespace App\Livewire\Commerce\Sale;

use App\Models\Store;
use Livewire\Component;
use App\Models\Commerce\Sale;
use Illuminate\Validation\Rule;
use App\Models\Warehouse\StockItem;
use App\Services\SaleService;
use App\Services\StockItemService;
use App\Traits\ReturnItemStatusInfo;

class CreateSale extends Component
{
    public Store $store;
    public ?Sale $sale;
    public $searchItem = '';
    public $editedItem = null;
    public  bool $editSoldPriceModal = false;
    
    protected StockItemService $stockItemService;
    protected SaleService $saleService;

    use ReturnItemStatusInfo;

    public function boot(StockItemService $stockItemService, SaleService $saleService)
    {
        $this->stockItemService = $stockItemService;
        $this->saleService = $saleService;
    }

    public function mount(Store $store, Sale $sale)
    {
        $this->store = $store;
        $this->sale = $sale;
        foreach ($this->sale->stockItems as $item) {
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

        if($item)
        {
            $this->stockItemService->assignToSale($item, $this->sale);
            $this->searchItem = '';
            $this->dispatch('item-added');
        } else {
            $checkItem = StockItem::where('id', $this->searchItem)->first();
            if($checkItem) {
                $this->addError(
                    'searchItem',
                    'Item #' . $checkItem->id . ' | ' . $this->returnItemStatusInfo($checkItem->id)
                );
            } else {
                $this->addError('searchItem', 'This item does not exist.');
            }
        }
    }

    public function removeItem(StockItem $item)
    {
        if($item->status !== StockItem::IN_PENDING_SALE) {
            $this->addError('searchItem', 'This item is not available for removal.');
            return;
        } else {
            $this->stockItemService->removeFromSale($item, $this->sale);
            $this->sale->refresh();
        }
    }    

    public function render()
    {
        return view('livewire.commerce.sale.create-sale', [
            'saleItems' => $this->sale->stockItems()->with(['brand', 'productVariant.product'])->get(),
        ]);
    }
}
