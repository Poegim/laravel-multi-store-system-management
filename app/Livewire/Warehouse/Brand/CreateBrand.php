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
    use HasModal;
    use InteractsWithBanner;
    use HasUpdatedName;

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

    public function store() {
        $validated = $this->validate();
        $flag = $this->brandService->store($validated);
        $this->resetVars();
        $this->modalVisibility = false;
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
