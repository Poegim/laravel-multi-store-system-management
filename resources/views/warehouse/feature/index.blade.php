<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Features') }}
        </h2>
    </x-slot>
    
    @livewire('warehouse.feature.show-features')

</x-app-layout>