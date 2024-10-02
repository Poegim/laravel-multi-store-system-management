<?php

namespace App\Livewire\Warehouse\Brand;

use Livewire\Component;
use App\Traits\HasModal;
use App\Services\BrandService;
use App\Traits\HasUpdatedName;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\InteractsWithBanner;

class CreateBrand extends Component
{
    // use HasModal;
    use InteractsWithBanner;
    use HasUpdatedName;

    public ?string $name;
    public ?string $slug;
    public bool $modalVisibility = false;
    public string $actionType = '';

    protected BrandService $brandService;

    public function rules()
    {
        return [
            'name' => [ 'required', 'string', 'max:50', 'min:2', Rule::unique('brands'),],
            'slug' => [ 'required', 'string', 'max:50', 'min:2', Rule::unique('brands'),]
        ];
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function boot(BrandService $brandService) {
        $this->brandService = $brandService;
    }
    
    public function showModal(string $actionType)
    {
        $this->actionType = $actionType;
        $this->modalVisibility = true;
        $this->name = '';
        $this->slug = '';
        
    }

    public function store() {
        $validated = $this->validate();
        $flag = $this->brandService->store($validated);
        $this->resetVars();
        $this->modalVisibility = false;
        $this->dispatch('brand-created'); 
        $flag ? $this->banner('Successfully created!') : $this->dangerBanner('An error was encountered while creating.');
    }

    public function resetVars()
    {
        $this->name;
        $this->slug;
    }

    public function render()
    {
        return view('livewire.warehouse.brand.create-brand');
    }
}
