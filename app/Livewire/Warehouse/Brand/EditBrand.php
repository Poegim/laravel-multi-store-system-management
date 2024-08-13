<?php

namespace App\Livewire\Warehouse\Brand;

use Livewire\Component;
use App\Traits\HasModal;
use Illuminate\Support\Str;
use App\Services\BrandService;
use App\Models\Warehouse\Brand;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\InteractsWithBanner;

class EditBrand extends Component
{
    use HasModal;
    use InteractsWithBanner;

    public ?Brand $brand;

    public ?string $name;
    public ?string $slug;

    protected BrandService $brandService;

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string', 
                'max:50',
                'min:2',
                Rule::unique('brands')->ignore($this->brand->id),
            ],
            'slug' => [
                'required',
                'string', 
                'max:50',
                'min:2',
                Rule::unique('brands')->ignore($this->brand->id),
            ]
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

    public function mount(Brand $brand) {
        $this->brand = $brand;
        $this->name = $brand->name;
        $this->slug = $brand->slug;
    }

    public function updatedName() 
    {
        $this->slug = Str::slug($this->name);
    }

    public function update() {
        $validated = $this->validate();
        $flag = $this->brandService->update($validated, $this->brand);
        $this->modalVisibility = false;
        if($flag) {
            $this->banner('Successfully updated!');
            $this->dispatch('updated');
         } else {
             $this->dangerBanner('An error was encountered while updating.');
         }
    }
    
    public function render()
    {
        return view('livewire.warehouse.brand.edit-brand');
    }
}
