<div class="space-y-4">
    <x-window>
        @if($errors->any())
            <x-lists.errors-list title="{{ __('Errors detected!') }}">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </x-lists.errors-list>
        @endif

        
        
        <div class="flex items-center gap-2">
            <input 
            class="border border-gray-300 p-1 rounded-lg text-sm" 
            type="text" placeholder="{{ __('Search for a item') }}" 
            wire:model="searchItem" 
            wire:keydown.enter="addItem"
            />
            <button 
                class="bg-blue-500 text-white text-sm p-1 px-2 rounded-lg" 
                wire:click="addItem"
                >
                Add
            </button>
            <x-action-message class="me-3 px-4 py-1 bg-green-200 font-bold" on="item-added">
                {{ __('Item added!') }}
            </x-action-message>
        </div>


    </x-window>

        <x-window>
        <div class="text-sm text-gray-800 grid grid-cols-2">
            <div>

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
                            {{ number_format($saleItems->sum(fn($item) => $item->soldPrice()) / 100, 2, ',', ' ') }}
                        </div>
                    </div>

                    <div class="flex mb-2 space-x-1">
                        <div>Zysk brutto:</div>
                        <div class="text-right">
                            {{ number_format(
                                ($saleItems->sum(fn($item) => $item->soldPrice()) - $saleItems->sum('purchase_price_gross')) / 100,
                                2,
                                ',',
                                ' '
                            ) }}                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <button 
                    class="bg-green-600 hover:bg-green-700 active:bg-green-800 
                           text-white font-semibold text-sm md:text-base 
                           px-4 py-2 rounded-xl shadow-md hover:shadow-lg 
                           transition-all duration-200 ease-in-out flex items-center gap-2"
                    wire:click="finalizeSale"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z"/>
                    </svg>
                    {{ __('Finalize Sale') }}
                </button>
            </div>
        </div>
    </x-window>


    <x-window>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-2">{{ __('Id') }}</th>
                    <th scope="col" class="p-2">{{ __('Item Name') }}</th>
                    <th scope="col" class="p-2">{{ __('Variant') }}</th>
                    <th scope="col" class="p-2">{{ __('PPN') }}</th>
                    <th scope="col" class="p-2">{{ __('PPG') }}</th>
                    <th scope="col" class="p-2">{{ __('Actions') }}</th>
                    <th scope="col" class="p-2">{{ __('SRP')}}</th>
                    <th scope="col" class="p-2">{{ __('Edit Price') }}</th>
                </tr>
            </thead>
            <tbody>
             
            @if(!$saleItems->isEmpty())
            @foreach ($saleItems as $saleItem)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="p-2">{{ $saleItem->id }}</td>
                    <td class="p-2">{{ $saleItem->brand->name }} {{ $saleItem->productVariant->product->name }}</td>
                    <td class="p-2">{{ $saleItem->productVariant->name }}</td>
                    <td class="p-2">{{ $saleItem->formattedPurchasePriceNet() }}</td>
                    <td class="p-2">{{ $saleItem->formattedPurchasePriceGross() }}</td>
                    <td class="p-2">
                            <button class="flex gap-1 hover:fill-red-500 text-red-600 hover:text-red-900" wire:click="removeItem({{ $saleItem->id }})" wire:click="removeItem({{ $saleItem }})">
                                <svg fill="#currentColor" class="size-6" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>remove</title> <path d="M11.188 4.781c6.188 0 11.219 5.031 11.219 11.219s-5.031 11.188-11.219 11.188-11.188-5-11.188-11.188 5-11.219 11.188-11.219zM11.25 17.625l3.563 3.594c0.438 0.438 1.156 0.438 1.594 0 0.406-0.406 0.406-1.125 0-1.563l-3.563-3.594 3.563-3.594c0.406-0.438 0.406-1.156 0-1.563-0.438-0.438-1.156-0.438-1.594 0l-3.563 3.594-3.563-3.594c-0.438-0.438-1.156-0.438-1.594 0-0.406 0.406-0.406 1.125 0 1.563l3.563 3.594-3.563 3.594c-0.406 0.438-0.406 1.156 0 1.563 0.438 0.438 1.156 0.438 1.594 0z"></path> </g></svg>
                                <div class="my-auto">
                                    {{ __('Remove') }}
                                </div>
                            </button>
                    </td>
                    <td class="p-2">
                        {{ $saleItem->formattedSRP() }}
                    </td>
                    <td class="p-2">
                        <button wire:click="showEditSoldPriceModal({{ $saleItem->id }})" class="text-blue-600 hover:text-blue-900">
                            {{ __('Edit') }}
                        </button>
                    </td>
                </tr>
                
            @endforeach
            @endif
            </tbody>
        </table>
    </x-window>


    <x-dialog-modal wire:model.live="editSoldPriceModal">
        <x-slot name="title">
            {{-- Edit {{ $editedItem?->id }} - {{ $editedItem?->productVariant->product->name }} - {{ $editedItem?->productVariant->name }} --}}
        </x-slot>

        <x-slot name="content">
            {{-- <div class="mt-4">
                <x-input type="number" min="0.01" max="100000" class="mt-1 block w-3/4" placeholder="{{ __('Suggested Retail Price') }}"
                            wire:model="editedItem.sold_price" />
                <x-input-error for="editedItem.sold_price" class="mt-2" />
            </div> --}}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('editSoldPriceModal')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="updateSoldPrice" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>



</div>
