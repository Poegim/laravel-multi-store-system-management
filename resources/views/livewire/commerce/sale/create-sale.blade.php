<div class="space-y-4">
    <x-window>
        @error('searchItem')
        <div class="mb-2 bg-red-900 text-white tex-sm p-1 px-2 w-full rounded-lg flex items-center">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        {{ $message }}
        </div>
        @enderror

        
        
        <div class="flex items-center gap-2">
            <input class="border border-gray-300 p-1 rounded-lg text-sm" type="text" placeholder="{{ __('Search for a item') }}" wire:model="searchItem" />
            <button class="bg-blue-500 text-white text-sm p-1 px-2 rounded-lg" wire:click="addItem">Add</button>
            <x-action-message class="me-3 px-4 py-1 bg-green-200 font-bold" on="item-added">
                {{ __('Item added!') }}
            </x-action-message>
        </div>


    </x-window>

        <x-window>
        <div class="text-sm text-gray-800">
            <h2 class="text-lg font-semibold mb-2">Podsumowanie sprzedaży</h2>
            <div class="">
                <div class="flex mb-2 space-x-1">
                    <div>Liczba przedmiotów:</div>
                    <div class="text-right">{{ $saleItems->count() }}</div>
                </div>

                <div class="flex mb-2 space-x-1">
                    <div>Łączna cena zakupu netto:</div>
                    <div class="text-right">
                        {{  number_format($saleItems->sum('purchase_price_net') / 100, 2, ',', ' ') }}
                    </div>
                </div>

                <div class="flex mb-2 space-x-1">
                    <div>Łączna cena zakupu brutto:</div>
                    <div class="text-right">
                        {{  number_format($saleItems->sum('purchase_price_gross') / 100, 2, ',', ' ') }}
                    </div>
                </div>

                <div class="flex mb-2 space-x-1">
                    <div>Łączna cena sprzedaży:</div>
                    <div class="text-right">
                        {{  number_format($saleItems->sum('sold_price') / 100, 2, ',', ' ') }}
                    </div>
                </div>

                <div class="flex mb-2 space-x-1">
                    <div>Zysk brutto:</div>
                    <div class="text-right">
                        {{  number_format($saleItems->sum('sold_price') / 100 - $saleItems->sum('purchase_price_gross') / 100, 2, ',', ' ') }}
                    </div>
                </div>
            </div>
        </div>
    </x-window>


    <x-window>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">{{ __('Id') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Item Name') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Variant') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('PPN') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('PPG') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Actions') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('SRP')}}</th>
                </tr>
            </thead>
            <tbody>
             
            @if(!$saleItems->isEmpty())
            @foreach ($saleItems as $saleItem)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $saleItem->id }}</td>
                    <td class="px-6 py-4">{{ $saleItem->brand->name }} {{ $saleItem->productVariant->product->name }}</td>
                    <td class="px-6 py-4">{{ $saleItem->productVariant->name }}</td>
                    <td class="px-6 py-4">{{ $saleItem->formattedPurchasePriceNet() }}</td>
                    <td class="px-6 py-4">{{ $saleItem->formattedPurchasePriceGross() }}</td>
                    <td class="px-6 py-4">
                            <button class="flex gap-1 hover:fill-red-500 text-red-600 hover:text-red-900" wire:click="removeItem({{ $saleItem->id }})" wire:click="removeItem({{ $saleItem }})">
                                <svg fill="#currentColor" class="size-6" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>remove</title> <path d="M11.188 4.781c6.188 0 11.219 5.031 11.219 11.219s-5.031 11.188-11.219 11.188-11.188-5-11.188-11.188 5-11.219 11.188-11.219zM11.25 17.625l3.563 3.594c0.438 0.438 1.156 0.438 1.594 0 0.406-0.406 0.406-1.125 0-1.563l-3.563-3.594 3.563-3.594c0.406-0.438 0.406-1.156 0-1.563-0.438-0.438-1.156-0.438-1.594 0l-3.563 3.594-3.563-3.594c-0.438-0.438-1.156-0.438-1.594 0-0.406 0.406-0.406 1.125 0 1.563l3.563 3.594-3.563 3.594c-0.406 0.438-0.406 1.156 0 1.563 0.438 0.438 1.156 0.438 1.594 0z"></path> </g></svg>
                                <div class="my-auto">
                                    {{ __('Remove') }}
                                </div>
                            </button>
                    </td>
                    <td class="px-6 py-4">
                        {{ $saleItem->formattedSRP() }}
                    </td>
                    <td>
                        <input type="number" min="0.01" max="100000" class="input-text" wire:model.live='saleItems.{{ $saleItem->id }}.sold_price' placeholder="{{$saleItem->formattedSRP()}}"/>
                    </td>
                </tr>
                
            @endforeach
            @endif
            </tbody>
        </table>
    </x-window>


</div>
