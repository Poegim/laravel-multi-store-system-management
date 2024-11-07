<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight lowercase">
            <div class="sm:flex py-6 px-4 {{ $store->storeBgColor() }}">
                {{-- <a class="link rounded-l pl-2 bg-white dark:bg-slate-800 " href="{{ route('store.index') }}"
                wire:navigate>{{ __('back to:') }} {{ __('stores') }}</a> --}}
                <div class="flex space-x-2 bg-white dark:bg-slate-800 px-2 rounded">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden sm:block size-5 my-auto -rotate-90">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg> --}}
                    {{ __('add_external_invoice_in') }}: {{ $store->name }}
                </div>
            </div>
        </h2>
    </x-slot>

    <x-window>
        <x-input
            name="invoice_number"
            id="invoice_number"
            placeholder="Enter invoice number"
            required
            maxlength="255"
        />

        <x-search-dropdown :collection="$companies" :inputName="'company_id'" :passedId="old('company_id') ?? null" :searchBy="'name'" />

    </x-window>

</x-app-layout>
