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
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">{{ __('Id') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Item Name') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Variant') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Price Net') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Price Gross') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
             
            @if(!$saleItems->isEmpty())
            @foreach ($saleItems as $sale)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $sale->id }}</td>
                    <td class="px-6 py-4">{{ $sale->name }}</td>
                    <td class="px-6 py-4">{{ $sale->variant }}</td>
                    <td class="px-6 py-4">{{ $sale->purchase_price_net }}</td>
                    <td class="px-6 py-4">{{ $sale->purchase_price_gross }}</td>
                    <td class="px-6 py-4">
                        <button class="text-red-600 hover:text-red-900" wire:click="removeItem({{ $sale->id }})">{{ __('Remove') }}</button>
                    </td>
                </tr>
                
            @endforeach
            @endif
            </tbody>
        </table>
    </x-window>

</div>
