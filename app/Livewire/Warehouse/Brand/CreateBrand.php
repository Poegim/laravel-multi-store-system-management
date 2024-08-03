<?php

namespace App\Livewire\Warehouse\Brand;

use App\HasModal;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Services\BrandService;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\InteractsWithBanner;

class CreateBrand extends Component
{
    use HasModal;
    use InteractsWithBanner;

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
                Rule::unique('brands'),
            ],
            'slug' => [
                'required',
                'string', 
                'max:50',
                'min:2',
                Rule::unique('brands'),
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

    public function updatedName() 
    {
        $this->slug = Str::slug($this->name);
    }

    public function store() {
        $validated = $this->validate();
        $flag = $this->brandService->store($validated);
        $this->modalVisibility = false;
        $flag ? $this->banner('Successfully created!') : $this->dangerBanner('An error was encountered while creating.');
    }

    public function render()
    {
        return view('livewire.warehouse.brand.create-brand');
    }
}
