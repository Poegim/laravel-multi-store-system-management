<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="top-header-breadcrumb-title">
            {{ __('Feature') }}: {{ $feature->name }}, {{ $feature->id }}
            </div>
        </h2>
    </x-slot>
    
    <x-window>
        @if ($feature->productVariants)
         
            @foreach ($feature->productVariants as $productVariant)
            <p>
                {{$productVariant->product->name }}, {{ $productVariant->id}}, {{ $productVariant->name }}
            </p>
            @endforeach

        @else
            <p>Didnt found any product variants realated to this feature.</p>
        @endif
    </x-window>

</x-app-layout>