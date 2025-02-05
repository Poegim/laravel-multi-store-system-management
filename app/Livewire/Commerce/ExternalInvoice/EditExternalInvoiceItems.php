<?php

namespace App\Livewire\Commerce\ExternalInvoice;

use App\Models\Color;
use App\Models\VatRate;
use Livewire\Component;
use App\Models\Warehouse\Brand;
use App\Models\Warehouse\Product;
use Illuminate\Support\Collection;
use App\Models\Commerce\ExternalInvoice;
use App\Services\TemporaryExternalInvoiceItemService;
use App\Models\Warehouse\TemporaryExternalInvoiceItem;
use App\Traits\FormatsAmount;
use App\Traits\NetToGrossConverts;
use App\Traits\Sortable;

class EditExternalInvoiceItems extends Component
{
    use FormatsAmount;
    use Sortable;
    use NetToGrossConverts;

    public ?Collection $colors;
    public ?Collection $vatRates;
    public $searchColor = '';
    public $color;

    public $brands;
    public $products;
    public $productVariants;
    public $devices;
    public ?Product $device;
    public ?Product $product;
    public ?int $vatRate;

    //Start of properties
    public ?int $brand;
    public ?int $productVariant;
    public ?int $selectedProduct;
    public ?int $selectedDevice;
    public ?int $selectedColor;
    public $srp;
    public ?string $imei_number;
    public ?string $serial_number;
    public ?int $quantity;
    public $purchase_price_net;
    public $purchase_price_gross;
    public $externalInvoiceId;
    public ?int $vatRateId;
    //End of properties

    public $searchProduct = '';
    public $searchDevice = '';

    public $lockBrand = false;
    public $lockQuantity = false;
    public $aggregate = false;

    public ?ExternalInvoice $externalInvoice = null;
    protected TemporaryExternalInvoiceItemService $temporaryExternalInvoiceItemService;

    protected function rules()
    {
        return [
            'brand' => [
                'required', 'exists:brands,id',
            ],
            'externalInvoiceId' => [
                'required', 'exists:external_invoices,id',
            ],
            'selectedProduct' => [
                'required', 'exists:products,id',
            ],
            'productVariant' => [
                'required', 'exists:product_variants,id',
            ],
            'selectedDevice' => [
                'required', 'exists:products,id',
            ],
            'selectedColor' => [
                'required', 'exists:colors,id',
            ],
            'imei_number' => ['string', 'max:25', 'nullable', 'unique:temporary_external_invoice_items,imei_number'],
            'serial_number' => ['string', 'max:50', 'nullable', 'unique:temporary_external_invoice_items,serial_number'],
            'srp' => ['required', 'numeric', 'min:0', 'max:99999.99'],
            'quantity' => ['required', 'numeric', 'integer', 'min:1', 'max:99999'],
            'purchase_price_net' => ['required', 'numeric', 'min:0.01', 'max:99999.99'],
            'purchase_price_gross' => ['required', 'numeric', 'min:0.01', 'max:9999999'],
            'vatRateId' => ['required', 'exists:vat_rates,id'],
            'vatRate' => ['required', 'numeric', 'min:0', 'max:99.99'],
        ];
    }

    public function boot(TemporaryExternalInvoiceItemService $temporaryExternalInvoiceItemService) {
        $this->temporaryExternalInvoiceItemService = $temporaryExternalInvoiceItemService;
    }

    public function mount(ExternalInvoice $externalInvoice) {
        $this->externalInvoice = $externalInvoice;
        $this->externalInvoiceId = $externalInvoice->id;
        $this->brands = Brand::select('id', 'name')->orderBy('id')->get();
        $this->products = Product::select('id', 'name')->inRandomOrder()->limit(200)->get();
        $this->devices = Product::devices()->select('id', 'name')->limit(100)->get();
        $this->colors = Color::all();
        $this->srp = 0;
        $this->imei_number = '';
        $this->serial_number = '';
        $this->quantity = 0;
        $this->purchase_price_net = 0;
        $this->purchase_price_gross = 0;
        $this->vatRates = VatRate::pluck('rate', 'id');
        $this->vatRateId = VatRate::getDefault()->id;
        $this->vatRate = $this->vatRates[$this->vatRateId];

    }

    public function updatedVatRateId($vatRateId) {
        $this->vatRateId = $vatRateId;
        $this->vatRate = $this->vatRates[$vatRateId];
        $this->refreshGrossPurchasePrice();
    }

    public function updatedPurchasePriceNet($purchasePriceNet) {
        // Validate if the input is a numeric value
        if (!is_numeric($purchasePriceNet)) {
            $this->purchase_price_gross = 0;
            return; // Exit the function if the input is invalid
        }

        // Convert input to a float to ensure correct calculations
        $purchasePriceNet = (float) $purchasePriceNet;

        // Calculate the gross purchase price
        $this->refreshGrossPurchasePrice($purchasePriceNet);
    }


    public function updatedSearchProduct()
    {
        $this->products = Product::select('id', 'name')->where('name', 'like', '%'.$this->searchProduct.'%')->limit(500)->get();
    }

    public function updatedSearchDevice()
    {
        $this->devices = Product::select('id', 'name')->devices()->where('name', 'like', '%'.$this->searchDevice.'%')->limit(100)->get();
    }

    public function updatedSearchColor()
    {
        $this->colors = Color::where('name', 'like', '%'.$this->searchColor.'%')->get();
    }

    public function refreshGrossPurchasePrice()
    {
        $this->purchase_price_gross = $this->convertNetToGross($this->decimalToInteger($this->purchase_price_net), $this->vatRate);
    }

    public function setColor($color) {
        $this->color = $color;
        $this->selectedColor = $color['id'];
    }

    public function selectProduct($id)
    {
        $this->selectedProduct = $id;
        $this->searchProduct = $this->products->firstWhere('id', $id)->name;
        $this->product = Product::findOrFail($id);
        $this->productVariants = $this->product->productVariants;
        $this->productVariant = $this->productVariants[0]->id;
        if($this->product->is_device) {
            $this->brand = $this->product->brand->id;
            $this->selectedDevice = $this->product->id;
            $this->lockBrand = true;
            $this->lockQuantity = true;
            $this->quantity = 1;
        } else {
            $this->lockBrand = false;
            $this->lockQuantity = false;
        }

        $this->imei_number = '';
        $this->serial_number = '';
    }

    public function selectDevice($id)
    {
        $this->selectedDevice = $id;
        $this->searchDevice = $this->devices->firstWhere('id', $id)->name;
        $this->device = Product::findOrFail($id);
    }

    public function addItems()
    {
        $validated = $this->validate();

        try {
            for ($i = 0; $i < $validated['quantity']; $i++) {
                $this->temporaryExternalInvoiceItemService->store($validated);
            }

            $this->resetVars();
            $this->dispatch('items-added');

        } catch (\Exception $e) {
            $this->addError('externalInvoiceId', $e->getMessage());
        }
    }

    public function resetVars()
    {
        $this->reset([
            'brand',
            'color',
            'productVariant',
            'selectedProduct',
            'selectedDevice',
            'selectedColor',
            'srp',
            'imei_number',
            'serial_number',
            'quantity',
            'purchase_price_net',
            'purchase_price_gross',
            'product',
            'productVariants',
        ]);
    }

    public function render()
    {
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';

        $temporaryItems =
        TemporaryExternalInvoiceItem::where('external_invoice_id', $this->externalInvoiceId)
        ->orderBy($this->sortField, $sortDirection)->get();

        return view('livewire.commerce.external-invoice.edit-external-invoice-items', [
            'temporaryItems' => $temporaryItems,
        ]);
    }
}
