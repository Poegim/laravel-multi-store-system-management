<?php

namespace App\Livewire\Management\Store;

use App\Models\Color;
use App\Models\Store;
use App\Services\StoreService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class ShowStores extends Component
{
    use InteractsWithBanner;

    protected StoreService $storeService;

    public bool $modalVisibility = false;
    public string $activeModalTab = 'A';
    public ?string $actionType;
    public ?Store $store = null;
    public ?Collection $colors;

    //DB Columns
    public ?string $name;
    public ?int $order;
    public ?string $email;
    public ?int $phone;
    public ?string $city;
    public ?int $postcode;
    public ?string $street;
    public ?string $building_number;
    public ?string $apartment_number;
    public int $color_id = 1;
    public ?string $contracts_prefix;
    public ?string $invoices_prefix;
    public ?string $margin_invoices_prefix;
    public ?string $proforma_invoices_prefix;
    public ?string $internal_servicing_prefix;
    public ?string $external_servicing_prefix;
    public ?int $next_receipt_number;
    public ?int $next_invoice_number;
    public ?int $next_margin_invoice_number;
    public ?int $next_proforma_invoice_number;
    public ?int $next_internal_servicing_number;
    public ?int $next_external_servicing_number;
    public ?string $description;

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function rules() : Array
    {
        $rules = [
            'email' => [
               'required', 
               'email',
            ],
            'order' => 'required|numeric',
            'phone' => 'required|numeric',
            'city' => 'required|min:2|max:255',
            'postcode' => 'required|numeric|max_digits:5|min_digits:5',
            'street' => 'max:255',
            'building_number' => 'max_digits:255',
            'apartment_number' => 'max_digits:255',
            'next_receipt_number' => 'required|numeric|min:1',
            'next_invoice_number' => 'required|numeric|min:1',
            'next_margin_invoice_number' => 'required|numeric|min:1',
            'next_proforma_invoice_number' => 'required|numeric|min:1',
            'next_internal_servicing_number' => 'required|numeric|min:1',
            'next_external_servicing_number' => 'required|numeric|min:1',
            'description' => 'max:2000',
        ];

        if($this->store != null) {
            $rules['name'] = [
                'required', 
                'min:3',
                'max:255',
                Rule::unique('stores')->ignore($this->store->name, 'name'),
            ];
            $rules['color_id'] = [
                'exists:colors,id',
                Rule::unique('stores')->ignore($this->store->color_id, 'color_id'),
            ];
            $rules['contracts_prefix'] = [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores')->ignore($this->store->contracts_prefix, 'contracts_prefix'),
            ];
            $rules['invoices_prefix'] = [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores')->ignore($this->store->invoices_prefix, 'invoices_prefix'),
            ];
            $rules['margin_invoices_prefix'] = [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores')->ignore($this->store->margin_invoices_prefix, 'margin_invoices_prefix'),
            ];
            $rules['proforma_invoices_prefix'] = [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores')->ignore($this->store->proforma_invoices_prefix, 'proforma_invoices_prefix'),
            ];
            $rules['internal_servicing_prefix'] = [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores')->ignore($this->store->internal_servicing_prefix, 'internal_servicing_prefix'),
            ];
            $rules['external_servicing_prefix'] = [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores')->ignore($this->store->external_servicing_prefix, 'external_servicing_prefix'),
            ];

        } elseif($this->store === null) {
            $rules['name'] = [
                'required', 
                'min:3',
                'max:255',
                Rule::unique('stores'),
            ];
            $rules['color_id'] = [
                'exists:colors,id',
                Rule::unique('stores'),
            ];
            $rules['contracts_prefix'] = [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores'),
            ];
            $rules['invoices_prefix'] = [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores'),
            ];
            $rules['margin_invoices_prefix'] = [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores'),
            ];
            $rules['proforma_invoices_prefix'] = [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores'),
            ];
            $rules['internal_servicing_prefix'] = [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores'),
            ];
            $rules['external_servicing_prefix'] = [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores'),
            ];
        }

        return $rules;
    }

    public function boot(StoreService $storeService) {
        $this->storeService = $storeService;
        $this->colors = Color::all();
    }

    public function showModal(string $actionType)
    {
        $this->actionType = $actionType;
        $this->modalVisibility = true;
    }


    public function create()
    {
        $this->resetVars();
        $this->activeModalTab = 'A';
        $this->showModal('create');
    }

    public function storeModel()
    {
        $validated = $this->validate();
        if($validated) {
            $flag = $this->storeService->store($validated);
            $this->modalVisibility = false;
            $flag ? $this->banner('Create successful.') : $this->dangerBanner('An error was encountered while creating.');
        } else {
            abort(403, 'Unknown error, cant store');
        }
    }

    public function edit(int $id)
    {
        $this->store = Store::findOrFail($id);
        $this->associate();
        $this->showModal('edit');
    }

    public function update(int $id)
    {
        $validated = $this->validate();
        if($validated) {
            $flag = $this->storeService->update($validated, $id);
            $this->modalVisibility = false;
            $flag ? $this->banner('Update successful.') : $this->dangerBanner('An error was encountered while saving.');
        } else {
            abort(403, 'Unknown error, cant update');
        }

    }

    public function associate()
    {
        $this->name = $this->store->name;
        $this->order = $this->store->order;
        $this->email = $this->store->email;
        $this->phone = $this->store->phone;
        $this->city = $this->store->city;
        $this->postcode = $this->store->postcode;
        $this->street = $this->store->street;
        $this->building_number = $this->store->building_number;
        $this->apartment_number = $this->store->apartment_number;
        $this->color_id = $this->store->color_id;
        $this->contracts_prefix = $this->store->contracts_prefix;
        $this->invoices_prefix = $this->store->invoices_prefix;
        $this->margin_invoices_prefix = $this->store->margin_invoices_prefix;
        $this->proforma_invoices_prefix = $this->store->proforma_invoices_prefix;
        $this->internal_servicing_prefix = $this->store->internal_servicing_prefix;
        $this->external_servicing_prefix = $this->store->external_servicing_prefix;
        $this->next_receipt_number = $this->store->next_receipt_number;
        $this->next_invoice_number = $this->store->next_invoice_number;
        $this->next_margin_invoice_number = $this->store->next_margin_invoice_number;
        $this->next_proforma_invoice_number = $this->store->next_proforma_invoice_number;
        $this->next_internal_servicing_number = $this->store->next_internal_servicing_number;
        $this->next_external_servicing_number = $this->store->next_external_servicing_number;
        $this->description = $this->store->description;
    }

    private function resetVars()
    {
        $this->name = null;
        $this->order = null;
        $this->email = null;
        $this->phone = null;
        $this->city = null;
        $this->postcode = null;
        $this->street = null;
        $this->building_number = null;
        $this->apartment_number = null;
        $this->color_id = 1;
        $this->contracts_prefix = null;
        $this->invoices_prefix = null;
        $this->margin_invoices_prefix = null;
        $this->proforma_invoices_prefix = null;
        $this->internal_servicing_prefix = null;
        $this->external_servicing_prefix = null;
        $this->next_receipt_number = null;
        $this->next_invoice_number = null;
        $this->next_margin_invoice_number = null;
        $this->next_proforma_invoice_number = null;
        $this->next_internal_servicing_number = null;
        $this->next_external_servicing_number = null;
        $this->description = null;

        $this->store = null;
    }
    
    public function render()
    {
        return view('livewire.management.store.show-stores', [
            'stores' => Store::all(),
        ]);
    }
}
