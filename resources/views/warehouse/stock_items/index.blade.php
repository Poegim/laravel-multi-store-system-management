<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight lowercase">
            <div class="top-header-breadcrumb-title {{ $store?->storeBgColor() }}">
                <div class="flex space-x-2 bg-white dark:bg-slate-800 px-2 rounded">
                    {{ __('Stock') }} {{ $store?->name }}
                </div>
            </div>
        </h2>
    </x-slot>

    <x-window>
        
    </x-window>

    

</x-app-layout>