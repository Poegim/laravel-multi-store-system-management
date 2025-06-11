<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb md:text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="top-header-breadcrumb-title">
            {{ __('Product variant') }}: {{ $productVariant->id}}
            </div>
        </h2>
    </x-slot>
    
    <x-window>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs uppercase">
                <tr class="text-black dark:text-white">
                    <th scope="col" class="px-6 py-3 uppercase">
                            {{__('id')}}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                            {{__('brand')}}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                            {{__('SRP')}}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                            {{__('PPN')}}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                            {{__('PPG')}}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                            {{__('color')}}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                            {{__('store')}}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productVariant->stockItems as $stockItem)
                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700" >
                    <td class="px-6 py-1 dark:text-gray-100 font-thin">
                        {{ $stockItem->id }}
                    </td>
                    <td class="px-6 py-1 dark:text-gray-100">
                        <a href="{{ route('brand.show', $stockItem->brand->slug) }}" class="link">
                            {{ $stockItem->brand->name }}
                        </a>
                    </td>
                    <td class="px-6 py-1 dark:text-gray-100 font-thin">
                        {{ $stockItem->formattedSRP() }}
                    </td>
                    <td class="px-6 py-1 dark:text-gray-100 font-thin">
                        {{ $stockItem->formattedPurchasePriceNet() }}
                    </td>
                    <td class="px-6 py-1 dark:text-gray-100 font-thin">
                        {{ $stockItem->formattedPurchasePriceGross() }}
                    </td>
                    <td class="px-6 py-1 dark:text-gray-100 font-thin">
                        {{ $stockItem->color }}
                    </td>
                    <td class="px-6 py-1 dark:text-gray-100">
                        <a href="{{ route('store.show', $stockItem->store->id )}}" class="link">
                            {{ $stockItem->store->name }}
                        </a>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        
    </x-window>    

</x-app-layout>