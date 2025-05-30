<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="top-header-breadcrumb-title">
            {{ __('Features') }}
            </div>
        </h2>
    </x-slot>
    
    @livewire('warehouse.feature.index-features')

</x-app-layout>