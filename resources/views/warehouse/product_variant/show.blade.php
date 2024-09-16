<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="sm:flex py-6 px-4">
            {{ __('Product variant') }}: {{ $productVariant->id}}
            </div>
        </h2>
    </x-slot>
    
    <x-window>
        @foreach ($productVariant->stockItems as $stockItem)
        <p>
            {{ $stockItem->id}}, {{$stockItem->color}}, {{ $stockItem->store_id}}
        </p>    
        @endforeach
    </x-window>    

</x-app-layout>