<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="top-header-breadcrumb-title">
            {{ __('stores') }}
            </div>
        </h2>
        

    </x-slot>
    
    @livewire('management.store.index-stores')

</x-app-layout>
