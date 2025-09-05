<?php

namespace App\Livewire\Commerce\Sale;

use App\Models\Store;
use App\Models\Contact;
use App\Rules\ValidNip;
use Livewire\Component;
use App\Models\Commerce\Sale;
use App\Services\SaleService;
use App\Traits\FormatsAmount;
use Illuminate\Validation\Rule;
use App\Services\StockItemService;
use Illuminate\Support\Facades\DB;
use App\Models\Warehouse\StockItem;
use App\Traits\ReturnItemStatusInfo;

class CreateSale extends Component
{
    public ?Contact $selectedContact = null;
    public ?int $selectedContactId = null;
    public $contacts = null;

    public Store $store;
    public ?Sale $sale;
    public $searchItem = '';
    public bool $editSoldPriceModal = false;
    public bool $finalizeSaleModal = false;
    public int $contactType = 1; // 1 = customer, 2 = company

    public string $receiptType = 'receipt'; // receipt, receipt_nip, invoice

    public string $nipNumber = '';
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
            $this->nipNumber = ''; // clear nipNumber
            $this->selectedContact = null; // clear selected contact
        }

        if ($value === 'receipt_nip') {
            // keep nipNumber, user should fill it
            $this->selectedContact = null; // clear selected contact
            $this->selectedContactId = null;
        }

        if ($value === 'invoice') {
            $this->nipNumber = ''; // clear nipNumber
        }
    }

    public function selectContact(Contact $contact)
    {
        $this->selectedContact = $contact;
        $this->selectedContactId = $contact->id;
        $this->receiptType = 'invoice';
        $this->searchContact = $contact->name;
        $this->contacts = collect([$contact]);

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
        if ($this->receiptType === 'receipt_nip') {
        
            $this->validate([
            'receiptType' => ['required', Rule::in(['receipt', 'receipt_nip', 'invoice'])],
            'nipNumber' => ['required', new ValidNip()],
            ]);

        } elseif ($this->receiptType === 'invoice') {
            $this->validate([
                'receiptType'     => ['required', Rule::in(['receipt', 'receipt_nip', 'invoice'])],
                'selectedContactId' => ['required', 'exists:contacts,id'],
            ], [
                'selectedContactId.required' => 'Please select a contact for the invoice.',
            ]);
        } else {
            $this->validate([
                'receiptType' => ['required', Rule::in(['receipt', 'receipt_nip', 'invoice'])],
            ]);
        }

        if($this->sale->stockItems->count() == 0) {
            $this->addError('finalizeSale', 'Cannot finalize an empty sale. Please add at least one item.');
            return;
        }

        $sale_status = $this->saleService->finalizeSale($this->sale, $this->nipNumber, $this->selectedContactId, $this->receiptType);
        
        if (! $sale_status) {
            $this->addError('finalizeSale', 'An error occurred while finalizing the sale. Please try again.');
            return;
        } else 
        {
            return redirect()->route('sale.show', [$this->sale, $this->sale->store]);
        }

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
