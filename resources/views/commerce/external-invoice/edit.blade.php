<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="sm:flex py-6 px-4">
            {{__('edit_invoice')}}: {{ $externalInvoice->invoice_number}}
            </div>
        </h2>
    </x-slot>

    @if($externalInvoice->is_temp)
    @livewire('commerce.external-invoice.edit-external-invoice-items', ['externalInvoice' => $externalInvoice])
    @endif

</x-app-layout>
