<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb md:text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="top-header-breadcrumb-title">
            {{ __('Categories') }}
            </div>
        </h2>
    </x-slot>

    @livewire('warehouse.category.index-categories')

</x-app-layout>
