<?php

namespace App\Livewire\Warehouse\Brand;

use Livewire\Component;
use App\Traits\HasModal;
use App\Traits\Sortable;
use App\Traits\Searchable;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Services\BrandService;
use App\Traits\HasUpdatedName;
use App\Models\Warehouse\Brand;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\InteractsWithBanner;


class IndexBrands extends Component
{
    use WithPagination;
    use Sortable;
    use Searchable;
    use InteractsWithBanner;
    use HasModal;
    use HasUpdatedName;

    public ?Brand $brand;

    public ?string $name;
    public ?string $slug;

    protected BrandService $brandService;

    #[On('brand-created')] 
    public function refreshPage()
    {
        $this->resetPage();
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function boot(BrandService $brandService) {
        $this->brandService = $brandService;
    }

    public function rules()
    {
        return [
            'name' => [
                'required', 'string', 'max:50', 'min:2', Rule::unique('brands')->ignore($this->brand->id),
            ],
            'slug' => [
                'required', 'string', 'max:50', 'min:2', Rule::unique('brands')->ignore($this->brand->id),
            ]
        ];
    }

    public function update() {
        $validated = $this->validate();
        $flag = $this->brandService->update($validated, $this->brand);
        $this->modalVisibility = false;
        if($flag) {
            $this->banner('Successfully updated!');
         } else {
             $this->dangerBanner('An error was encountered while updating.');
        }
        $this->resetPage();
    }

    public function edit(Brand $brand)
    {
        $this->brand = $brand;
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->showModal('edit');
    }

    public function render()
    {
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';

        $brands = Brand::where('name', 'like', '%'.$this->search.'%')
                    ->orderBy($this->sortField, $sortDirection)
                    ->withCount('stockItems')
                    ->paginate(10);

        return view('livewire.warehouse.brand.index-brands', compact('brands'));
    }
}
