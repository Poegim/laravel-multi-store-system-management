<?php

namespace App\Livewire\Commerce\Sale;

use App\Models\Store;
use Livewire\Component;
use App\Models\Commerce\Sale;
use App\Models\Contact;
use Illuminate\Validation\Rule;
use App\Models\Warehouse\StockItem;
use App\Services\SaleService;
use App\Services\StockItemService;
use App\Traits\FormatsAmount;
use App\Traits\ReturnItemStatusInfo;
use Illuminate\Support\Facades\DB;

class CreateSale extends Component
{
    public ?Contact $selectedContact = null;
    public $contacts = null;

    public Store $store;
    public ?Sale $sale;
    public $searchItem = '';
    public bool $editSoldPriceModal = false;
    public bool $finalizeSaleModal = false;
    public int $contactType = 1; // 1 = customer, 2 = company

    public string $receiptType = 'receipt'; // receipt, receipt_nip, invoice

    public int $nipNumber = 0;
    public string $searchContact = '';

    public $editedPrice = null;
    public $editedItemId = null;
    public ?StockItem $editedItem = null;

    public int $totalSoldPrice = 0;
    public int $totalPurchaseNet = 0;
    public int $totalPurchaseGross = 0;

    protected StockItemService $stockItemService;
    protected SaleService $saleService;

    use ReturnItemStatusInfo;
    use FormatsAmount;

    public function boot(StockItemService $stockItemService, SaleService $saleService)
    {
        $this->stockItemService = $stockItemService;
        $this->saleService = $saleService;
    }

    public function mount(Store $store, Sale $sale)
    {
        $this->store = $store;
        $this->sale = $sale;
        $this->contacts = Contact::orderBy('name')->where('type', $this->contactType)->limit(100)->get();
    }

    public function updatedSearchContact()
    {
        if($this->searchContact != '') {
            $this->contacts = Contact::where('name', 'like', "%{$this->searchContact}%")
                ->where('type', $this->contactType)
                ->orWhere('identification_number', 'like', "%{$this->searchContact}%")
                ->orderBy('name')
                ->limit(100)
                ->get();
        } else {
            $this->contacts = Contact::orderBy('name')->where('type', $this->contactType)->limit(100)->get();
        }
    }

    public function updatedReceiptType($value)
    {
        if ($value === 'receipt') {
            $this->nipNumber = 0; // clear nipNumber
            $this->selectedContact = null; // clear selected contact
        }

        if ($value === 'receipt_nip') {
            // keep nipNumber, user should fill it
            $this->selectedContact = null; // clear selected contact
        }

        if ($value === 'invoice') {
            $this->nipNumber = 0; // clear nipNumber
        }
    }


    public function showEditSoldPriceModal($stockItemId)
    {
        $this->editedItem = $this->sale->stockItems()->where('stock_item_id', $stockItemId)->first();
        if (! $this->editedItem) return;

        $this->editedItemId = $stockItemId;
        $this->editedPrice =  $this->integerToDecimal($this->editedItem->pivot->price);
        $this->editSoldPriceModal = true;

    }

    public function showFinalizeSaleModal()
    {
        $this->finalizeSaleModal = true;
    }

    public function finalizeSale()
    {
        $this->validate([
            'receiptWithNIPRequest' => 'boolean',
            'nipNumber' => 'nullable|digits:10',
        ]);

        if($this->receiptWithNIPRequest && !$this->nipNumber) {
            $this->addError('nipNumber', 'NIP number is required when receipt with NIP is selected.');
            return;
        }

        $this->saleService->finalizeSale($this->sale, $this->receiptWithNIPRequest, $this->invoiceRequest, $this->nipNumber);

        return redirect()->route('commerce.sales.show', ['store' => $this->store->id, 'sale' => $this->sale->id]);
    }


    public function updateSoldPrice()
    {
            $this->validate([
                'editedPrice' => 'required|numeric|min:0.01|max:100000',
            ]);

            $this->sale->stockItems()->updateExistingPivot($this->editedItemId, [
                'price' => $this->decimalToInteger((float) $this->editedPrice), // tu też trait
            ]);

            $this->editedItem = null;
            $this->editedItemId = null;
            $this->editedPrice = null;

            $this->editSoldPriceModal = false;
            $this->dispatch('sold-price-updated');
            $this->sale->refresh();
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

    public function calculateTotals(): void
    {
        $items = $this->sale->stockItems;

        $this->totalSoldPrice = $items->sum(fn ($item) => $item->pivot->price);
        $this->totalPurchaseNet = $items->sum('purchase_price_net');
        $this->totalPurchaseGross = $items->sum('purchase_price_gross');
    }

    public function render()
    {


        $this->calculateTotals();
        return view('livewire.commerce.sale.create-sale', [
            'saleItems' => $this->sale->stockItems()->with(['brand', 'productVariant.product'])->orderByPivot('created_at', 'desc')->get(),
        ]);
    }
}
