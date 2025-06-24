<x-window x-data="{ fullScreen: false }">
    <div :class="fullScreen ? 'absolute top-0 left-0 right-0 bottom-0 bg-white p-2 sm:p-4' : ''">
        <div>
            <div class="flex justify-end items-center mb-2 gap-2">
                <div>
                    @if ($filters)                        
                    @foreach($filters as $key => $value)
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 rounded-full mr-2">
                            {{ $key }}: <span class="font-semibold">{{ $value['name'] }}</span>
                            <button class="ml-1 text-red-500 hover:text-red-700" wire:click="removeFilter('{{ $key }}')">&times;</button>
                        </span>
                    @endforeach
                    @endif
                </div>
                <!-- Input search -->
                <input type="text" id="search" name="search"
                    
                    wire:model.debounce.500ms.live="search"
                    class="rounded-lg border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-300 h-10 w-full sm:w-64 px-3 text-sm"
                    placeholder="{{ __('Search...') }}"
                />

                <div class="flex gap-2">
                    <div class="my-auto text-sm text-gray-600 dark:text-gray-300">
                        {{ __('show_per_page') }}
                    </div>
                    <select name="perPage" id="perPage" wire:model.live="perPage" class="input-jetstream h-10 text-sm">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <x-secondary-button @click="fullScreen = !fullScreen">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14 3.414L9.414 8 14 12.586v-2.583h2V16h-6v-1.996h2.59L8 9.414l-4.59 4.59H6V16H0v-5.997h2v2.583L6.586 8 2 3.414v2.588H0V0h16v6.002h-2V3.414zm-1.415-1.413H10V0H6v2H3.415L8 6.586 12.585 2z" fill-rule="evenodd"></path> </g></svg>
                </x-secondary-button>
            </div>
            <table class="rounded-2xl overflow-hidden min-w-full text-xs text-left text-gray-700 dark:text-gray-300 border dark:border-gray-700">
                <thead class="uppercase bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-1 sm:py-2 cursor-pointer" wire:click="sortBy('id')">{{ __('Id') }}
                        <x-sort-icon field="id" :sortField="$sortField" :sortAsc="$sortAsc" />
                    </th>
                    <th class="px-4 py-1 sm:py-2 cursor-pointer" wire:click="sortBy('brand_id')">{{ __('Brand') }}
                        <x-sort-icon field="brand_id" :sortField="$sortField" :sortAsc="$sortAsc" />
                    </th>
                    <th class="px-4 py-1 sm:py-2">{{ __('Item Name') }}</th>
                    <th class="px-4 py-1 sm:py-2 hidden lg:table-cell">{{ __('Variant') }}</th>
                    <th class="px-4 py-1 sm:py-2 cursor-pointer" wire:click="sortBy('purchase_price_net')">{{ __('Price Net') }}
                        <x-sort-icon field="purchase_price_net" :sortField="$sortField" :sortAsc="$sortAsc" />
                    </th>
                    <th class="px-4 py-1 sm:py-2">{{ __('Price Gross') }}</th>
                    <th class="px-4 py-1 sm:py-2 cursor-pointer" wire:click="sortBy('suggested_retail_price')">{{ __('SRP') }}
                        <x-sort-icon field="suggested_retail_price" :sortField="$sortField" :sortAsc="$sortAsc" />
                    </th>
                    <th class="px-4 py-1 sm:py-2 hidden lg:table-cell">{{ __('VAT ') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stockItems as $item)
                     <tr class="bg-white dark:bg-gray-800 border-t hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-2 sm:py-2"><a class="link" href="{{ route('stock.show', $item) }}">{{ $item->id }}</a></td>
                        <td class="px-4 py-2 sm:py-2"><button class="link" wire:click="filterByBrand({{ $item->brand }})">{{ $item->brand->name }}</button></td>
                        <td class="px-4 py-2 sm:py-2"><button class="link" wire:click="filterByProduct({{ $item->productVariant->product }})">{{ $item->productVariant->product->name }}</button></td>
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
    </div>

</x-window>