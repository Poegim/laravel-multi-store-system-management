<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="sm:flex py-6 px-4">
            {{__('edit_invoice')}}: {{ $externalInvoice->invoice_number}}
            </div>
        </h2>
    </x-slot>

    <x-window>
        <form action="{{route('external-invoice.update', $externalInvoice->id)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-2">

                <x-input
                name="invoice_number"
                id="invoice_number"
                placeholder="Enter invoice number"
                required
                maxlength="255"
                minlength="3"
                class="w-full"
                value="{{ old('invoice_number') ?? $externalInvoice->invoice_number}}"
                />
                
                <x-search-dropdown :collection="$companies" :inputName="'contact_id'" :passedId="old('company_id') ?? $externalInvoice->contact_id" :optionalSearchBy="'identification_number'" />
                
                <x-button type="sumbit">Save and edit</x-button>
            </div>
        </form>
    </x-window>
    

</x-app-layout>
