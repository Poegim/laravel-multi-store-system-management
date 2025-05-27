<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight lowercase">
            <div class="sm:flex py-6 px-4 {{ $externalInvoice->store->storeBgColor() }}">
                <a class="link rounded-l pl-2 bg-white dark:bg-slate-800 " 
                    href="{{ route('external-invoice.index') }}"
                   wire:loading.class="opacity-50"
                   wire:target="store"
                   wire:loading.attr="aria-busy"
                   wire:loading.class="cursor-wait"
                   wire:navigate>{{ __('back to:') }} {{ __('Invoices') }}</a>
                <div class="flex space-x-2 bg-white dark:bg-slate-800 px-2 rounded">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden sm:block size-5 my-auto -rotate-90">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    {{ __('show: ') }} {{ $externalInvoice->store->name }}
                </div>
            </div>
        </h2>
    </x-slot>

    <x-window>
        <div class="flex flex-col space-y-4 text-sm">            
                <p><strong>{{ __('Invoice Number:') }}</strong> {{ $externalInvoice->invoice_number }}</p>
                <p><strong>{{ __('Price:') }}</strong> {{ $externalInvoice->price }}</p>
                <p><strong>{{ __('Status:') }}</strong> {{ $externalInvoice->status() }}</p>
                <p><strong>{{ __('Created At:') }}</strong> {{ $externalInvoice->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </x-window>

    @livewire('commerce.external-invoice.show-external-invoice', ['externalInvoice' => $externalInvoice])

    
</x-app-layout>