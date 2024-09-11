<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight lowercase">
            <div class="sm:flex py-6 px-4">
                <a class="link" href="{{ route('product.index') }} " wire:navigate>{{__('back to:')}}
                    {{ __('products') }}</a>
                <div class="flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="hidden sm:block size-5 my-auto -rotate-90">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    {{__('product')}}: {{ $product->name }}
                </div>
            </div>
        </h2>
    </x-slot>
    
    <x-window>
        @foreach ($product->productVariants as $variant)
        <div class="p-4">
            Variant name: {{ $variant->name }}
            <div>
                Compatibile with devices:
            </div>
            {{ dump($variant)}}
            <div class="p-2 bg-gray-200 rouded-mid mt-2">
                @foreach ($variant->devices as $device)
                <div class="ml-2">
                    {{ $device->name }}
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </x-window>

</x-app-layout>