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
                    {{__('product')}}: {{ $product->name }} ({{$product->id}})
                </div>
            </div>
        </h2>
    </x-slot>

    @if($product->productVariants->count() > 0)
    <x-window>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs uppercase">
                <tr class="text-black dark:text-white">
                    <th scope="col" class="px-6 py-3 uppercase">
                            {{__('id')}}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                            {{__('variant_name')}}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                            {{__('stock')}}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                            {{__('devices')}}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                            {{__('features')}}
                    </th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($product->productVariants as $variant)
                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700" >
                    <td class="px-6 py-1 dark:text-gray-100 font-thin">
                        {{ $variant->id }}
                    </td>
                    <td class="px-6 py-1 dark:text-gray-100">
                        <a href="{{route('product-variant.show', $variant->id)}}" label="{{$variant->name}}" class="link">
                            {{ Str::limit($variant->name, 25, '...') }}
                        </a>
                    </td>
                    <td class="px-6 py-1 dark:text-gray-100">
                        {{ $variant->stockItems->count() }}
                    </td>
                    <td x-data="{ open: false }" class="px-6 py-1 dark:text-gray-100 relative">
                        @if ($variant->devices->count() > 0)
                        @foreach ($variant->devices as $device)
                        <div x-show="open" >
                            <a class="link text-sm" href="{{ route('product.show', [$device->brand, $device]) }}">
                                {{$device->name}}
                            </a>
                        </div>
                        @endforeach
                        <button @click="open = ! open" class="absolute top-[1px] right-1 px-1 py-1 font-extrabold rounded transition-all duration-150" :class="open ? 'bg-red-200 dark:bg-red-700' : 'bg-green-200 dark:bg-green-700 rotate-180'">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>                    
                        @endif
                    </td>
                    <td x-data="{ open: false }" class="relative px-6 py-1 dark:text-gray-100">
                        @if ($variant->features->count() > 0)
                        @foreach ($variant->features as $feature)
                        <div x-show="open" >
                            <a class="link text-sm" href="{{ route('feature.show', $feature->slug) }}">
                                {{$feature->name}}
                            </a>
                        </div>
                        @endforeach
                        <button @click="open = ! open" class="absolute top-[1px] right-1 px-1 py-1 font-extrabold rounded transition-all duration-150" :class="open ? 'bg-red-200 dark:bg-red-700' : 'bg-green-200 dark:bg-green-700 rotate-180'">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>   
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-window>
    @endif

</x-app-layout>
