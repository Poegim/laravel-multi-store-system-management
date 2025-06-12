<x-window>
    <div class="overflow-x-auto">
        <table class="rounded-2xl overflow-hidden min-w-full text-xs text-left text-gray-700 dark:text-gray-300 border dark:border-gray-700">
            <thead class="uppercase bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
            <tr>
                <th class="px-4 py-1 sm:py-2">{{ __('Id') }}</th>
                <th class="px-4 py-1 sm:py-2">{{ __('Brand') }}</th>
                <th class="px-4 py-1 sm:py-2">{{ __('Item Name') }}</th>
                <th class="px-4 py-1 sm:py-2 hidden lg:table-cell">{{ __('Variant') }}</th>
                <th class="px-4 py-1 sm:py-2">{{ __('Price Net') }}</th>
                <th class="px-4 py-1 sm:py-2">{{ __('Price Gross') }}</th>
                <th class="px-4 py-1 sm:py-2">{{ __('SRP') }}</th>
                <th class="px-4 py-1 sm:py-2 hidden lg:table-cell">{{ __('VAT ') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stockItems as $item)
                 <tr class="bg-white dark:bg-gray-800 border-t hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <td class="px-4 py-2 sm:py-2">{{ $item->id }}</td>
                    <td class="px-4 py-2 sm:py-2">{{ $item->brand->name }}</td>
                    <td class="px-4 py-2 sm:py-2">{{ $item->productVariant->product->name }}</td>
                    <td class="px-4 py-2 sm:py-2 hidden lg:table-cell">{{ $item->productVariant->name }}</td>
                    <td class="px-4 py-2 sm:py-2">{{ $item->formattedPurchasePriceNet() }}</td>
                    <td class="px-4 py-2 sm:py-2">{{ $item->formattedPurchasePriceGross() }}</td>
                    <td class="px-4 py-2 sm:py-2">{{ $item->formattedSuggestedRetailPrice() }}</td>
                    <td class="px-4 py-2 sm:py-2 hidden lg:table-cell">{{ $item->vatRate->rate }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
    <div class="m-2">
        {{ $stockItems->links(data: ['scrollTo' => false]) }}
    </div>

</x-window>