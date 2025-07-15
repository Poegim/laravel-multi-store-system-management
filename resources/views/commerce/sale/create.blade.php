<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb md:text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="top-header-breadcrumb-title">
                <div class="flex space-x-2 bg-white dark:bg-slate-800 px-2 rounded">
                    {{ __('Sale in') }}: {{ $store?->name }}
                </div>
            </div>
        </h2>
    </x-slot>

    <livewire:commerce.sale.create-sale :store="$store" :sale="$sale" />

</x-app-layout>
