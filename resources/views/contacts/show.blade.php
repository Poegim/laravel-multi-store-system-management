<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb md:text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="top-header-breadcrumb-title">
           {{  $contact->name }}
            </div>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="flex flex-col space-y-4">
                    <div class="font-semibold text-gray-900 dark:text-white">
                        {{ __('Contact Details') }}
                    </div>
                    <div class="text-gray-700 dark:text-gray-300">
                        <p>{{ $contact->email }}</p>
                        <p>{{ $contact->phone }}</p>
                        <p>{{ $contact->type() }}</p>
                        <p>{{ $contact->identification_number }}</p>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="font-semibold text-gray-900 dark:text-white mb-4">
                    {{ __('Related External Invoices') }}
                </div>
                {{-- @livewire('commerce.external-invoice.index-external-invoices', ['contactId' => $contact->id]) --}}
            </div>
        </div>
    </div>

</x-app-layout>
