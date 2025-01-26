<?php

namespace App\Livewire\Commerce\ExternalInvoice;

use App\Models\Color;
use Livewire\Component;
use App\Models\Warehouse\Brand;
use App\Models\Warehouse\Product;
use Illuminate\Support\Collection;
use App\Models\Commerce\ExternalInvoice;

class EditExternalInvoiceItems extends Component
{
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
    public $net_buy_price;
    //End of properties

    public $searchProduct = '';
    public $searchDevice = '';

    public $lockBrand = false;
    public $lockQuantity = false;

    public ?ExternalInvoice $externalInvoice = null;

    protected function rules()
    {
        return [
            'brand' => [
                'required', 'exists:brands,id', 
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
            'imei_number' => ['string', 'max:25'],
            'serial_number' => ['string', 'max:50'],
            'srp' => ['required', 'numeric', 'min:0.01', 'max:99999.99'],
            'quantity' => ['required', 'numeric', 'min:1', 'max:99999'],
            'net_buy_price' => ['required', 'numeric', 'min:0.01', 'max:99999.99'],
        ];
    }

    public function mount(ExternalInvoice $externalInvoice) {
        $this->externalInvoice = $externalInvoice;
        $this->brands = Brand::select('id', 'name')->get();
        $this->products = Product::select('id', 'name')->limit(100)->get();
        $this->devices = Product::devices()->select('id', 'name')->limit(100)->get();
        $this->colors = Color::all();
        $this->srp = 0;
        $this->imei_number = '';
        $this->serial_number = '';
        $this->quantity = 0;
        $this->net_buy_price = 0;
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
            $this->lockBrand = true;
            $this->lockQuantity = true;
            $this->quantity = 1;
        } else {
            $this->lockBrand = false;
            $this->lockQuantity = false;
            $this->imei_number = '';
        }
    }

    public function selectDevice($id)
    {
        $this->selectedDevice = $id;
        $this->searchDevice = $this->devices->firstWhere('id', $id)->name;
        $this->device = Product::findOrFail($id);
    }

    public function addItems()
    {
        // dd([
        //     $this->brand,
        //     $this->product,
        //     $this->productVariant,
        //     $this->device,
        //     $this->srp,
        //     $this->imei_number,
        //     $this->quantity,
        //     $this->net_buy_price,
        // ]);

        $x = $this->validate();



    }

    public function render()
    {
        return view('livewire.commerce.external-invoice.edit-external-invoice-items');
    }
}
