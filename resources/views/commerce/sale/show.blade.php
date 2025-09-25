<x-app-layout>
    @if($errors->any())
    <x-window>
        <x-lists.errors-list title="{{ __('Errors detected!') }}">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </x-lists.errors-list>
    </x-window>
    @endif

<x-window>
    <div class="bg-white shadow rounded p-5 border border-gray-200 flex justify-between">

        <div class="space-y-2 ">
            <!-- Date and user -->
            <div class="flex items-center text-sm text-gray-700">
                <!-- User avatar -->
                <img src="{{ asset($sale->user->profile_photo_url) }}" 
                     alt="{{ $sale->user->name }}"
                     class="rounded-full w-10 h-10 object-cover mr-3">

                <!-- User info -->
                <div>
                    <p class="font-medium">{{ $sale->user->name }}</p>
                    <p class="text-xs text-gray-400">{{ $sale->created_at->format('d.m.Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div>
            
            <!-- Total -->
            <p class="text-lg font-bold text-green-600">
                {{ $sale->totalPrice() }}
            </p>

            <p>
                
            </p>
            
            @if($sale->conatct)
            <!-- Customer -->
            <p class="text-base text-gray-900">
                {{ $sale->contact ? $sale->contact->name : __('No customer') }}
            </p>
            @endif
            
        </div>
        
    </div>
</x-window>





    <x-window>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-2">{{ __('Id') }}</th>
                    <th scope="col" class="p-2">{{ __('Item Name') }}</th>
                    <th scope="col" class="p-2">{{ __('Variant') }}</th>
                    <th scope="col" class="p-2">{{ __('PPN') }}</th>
                    <th scope="col" class="p-2">{{ __('PPG') }}</th>
                    <th scope="col" class="p-2">{{ __('SRP')}}</th>
                    <th scope="col" class="p-2">{{ __('Final Price') }}</th>
                </tr>
            </thead>
            <tbody>
             
            @if(!$sale->stockItems->isEmpty())
            @foreach ($sale->stockItems as $saleItem)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="p-2">{{ $saleItem->id }}</td>
                    <td class="p-2">{{ $saleItem->brand->name }} {{ $saleItem->productVariant->product->name }}</td>
                    <td class="p-2">{{ $saleItem->productVariant->name }}</td>
                    <td class="p-2">{{ $saleItem->formattedPurchasePriceNet() }}</td>
                    <td class="p-2">{{ $saleItem->formattedPurchasePriceGross() }}</td>
                    <td class="p-2">
                        {{ $saleItem->formattedSRP() }}
                    </td>
                    <td class="p-2 font-semibold {{ $saleItem->pivot->price < $saleItem->purchase_price_gross ? 'text-red-600' : '' }} {{ $saleItem->pivot->price > $saleItem->purchase_price_gross ? 'text-green-600' : '' }}">
                        {{ number_format($saleItem->pivot->price / 100, 2, '.', ' ') }}

                    </td>
                </tr>
                
            @endforeach
            @endif
            </tbody>
        </table>
    </x-window>
</x-app-layout>