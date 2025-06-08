<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight lowercase">
            <div class="top-header-breadcrumb-title">
                <div class="flex space-x-2 bg-white dark:bg-slate-800 px-2 rounded">
                    {{ __('add_external_invoice_invoice') }}: {{ $store->name }}
                </div>
            </div>
        </h2>
    </x-slot>

    <x-window>
        
        @if ($errors->any())
        <x-lists.errors-list>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </x-lists.errors-list>
        @endif

        
        <form action="{{route('external-invoice.store', $store->id)}}" method="POST">
            @csrf
            @method('POST')

            <div class="space-y-2">

                <x-input
                name="invoice_number"
                id="invoice_number"
                placeholder="Enter invoice number"
                required
                maxlength="255"
                minlength="3"
                class="w-full"
                value="{{ old('invoice_number') }}"
                />
                
                <x-search-dropdown :collection="$companies" :inputName="'contact_id'" :passedId="old('company_id') ?? null" :optionalSearchBy="'identification_number'" />
                
                <x-button type="sumbit">Save and edit</x-button>
            </div>
        </form>

    </x-window>

</x-app-layout>
