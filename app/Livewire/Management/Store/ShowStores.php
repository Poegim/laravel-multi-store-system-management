<?php

namespace App\Livewire\Management\Store;

use App\Models\Store;
use App\Services\StoreService;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class ShowStores extends Component
{
    use InteractsWithBanner;

    protected StoreService $storeService;

    public bool $showEditModal = false;
    public ?Store $store;

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
    public ?string $color;
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

    public function rules() : Array
    {
        return [
            'name' => [
                'required', 
                'min:3',
                'max:255',
                Rule::unique('stores')->ignore($this->store->name, 'name'),
            ],

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
            'color' => 'hex_color',
            'contracts_prefix' => [
                'required',
                'max:8',
                'min:1',
                Rule::unique('stores')->ignore($this->store->contracts_prefix, 'contracts_prefix'),
            ],
            'invoices_prefix' => [
                'required',
                'max:8',
                'min:1',
                Rule::unique('stores')->ignore($this->store->invoices_prefix, 'invoices_prefix'),
            ],
            'margin_invoices_prefix' => [
                'required',
                'max:8',
                'min:1',
                Rule::unique('stores')->ignore($this->store->margin_invoices_prefix, 'margin_invoices_prefix'),
            ],
            'proforma_invoices_prefix' => [
                'required',
                'max:8',
                'min:1',
                Rule::unique('stores')->ignore($this->store->proforma_invoices_prefix, 'proforma_invoices_prefix'),
            ],
            'internal_servicing_prefix' => [
                'required',
                'max:8',
                'min:1',
                Rule::unique('stores')->ignore($this->store->internal_servicing_prefix, 'internal_servicing_prefix'),
            ],
            'external_servicing_prefix' => [
                'required',
                'max:8',
                'min:1',
                Rule::unique('stores')->ignore($this->store->external_servicing_prefix, 'external_servicing_prefix'),
            ],
            'next_receipt_number' => 'required|numeric|min:1',
            'next_invoice_number' => 'required|numeric|min:1',
            'next_margin_invoice_number' => 'required|numeric|min:1',
            'next_proforma_invoice_number' => 'required|numeric|min:1',
            'next_internal_servicing_number' => 'required|numeric|min:1',
            'next_external_servicing_number' => 'required|numeric|min:1',
            'description' => 'max:2000',
        ];
    }

    public function boot(StoreService $storeService) {
        $this->storeService = $storeService;
    }

    public function edit(int $id)
    {
        $this->store = Store::findOrFail($id);
        $this->associate();
        $this->showEditModal = true;
    }

    public function update(int $id)
    {
        $validated = $this->validate();
        if($validated) {
            $flag = $this->storeService->update($validated, $id);
            $this->showEditModal = false;
            $flag ? $this->banner('Update success.') : $this->dangerBanner('Error, update fail.');
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
        $this->color = $this->store->color;
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
    
    public function render()
    {
        return view('livewire.management.store.show-stores', [
            'stores' => Store::all(),
        ]);
    }
}
