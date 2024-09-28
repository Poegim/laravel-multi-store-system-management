<?php

namespace App\Livewire\Warehouse\ProductVariant;

use Livewire\Component;
use App\Traits\HasModal;
use App\Traits\HasUpdatedName;
use App\Models\Warehouse\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Services\ProductVariantService;
use Laravel\Jetstream\InteractsWithBanner;


/**
 * This component and child dropdrown component requires somehow 200ms.
 * Ill try to replace it as Controller bases CRUD.
 */

/**
 * CreateProductVariant class
 * @param Callection $products
 */
class CreateProductVariant extends Component
{
    use HasUpdatedName;
    use InteractsWithBanner;

    public ?Collection $products;

    // Inputs DB colums
    public ?string $name;
    public ?string $slug;
    public ?string $ean;
    public ?int $product_id;

    protected ?ProductVariantService $productVariantService;

    public bool $modalVisibility = false;
    public string $actionType = '';
    
    public function showModal(string $actionType)
    {
        $this->actionType = $actionType;
        $this->modalVisibility = true;
        $this->resetVars();
    }

    public function rules()
    {
        return [
            'name' => [
                'required', 'string', 'max:255', 'min:2',
            ],
            'slug' => [
                'required', 'string', 'max:255', 'min:2',
            ],
            'ean' => [
                'string', 'max:255', 'min:2', 'nullable',
            ],
            'product_id' => ['exists:products,id', 'required'],
        ];
    }
    
    
    
    public function boot(ProductVariantService $productVariantService)
    {
        $this->productVariantService = $productVariantService;
    }

    public function mount(Collection $products)
    {
        $this->products = $products;
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function store()
    {
        $validated = $this->validate();
    }

    public function resetVars()
    {
        $this->name = null;
        $this->slug = null;
        $this->ean = null;
        $this->product_id = null;
    }


    public function render()
    {
        return view('livewire.warehouse.product-variant.create-product-variant');
    }
}
