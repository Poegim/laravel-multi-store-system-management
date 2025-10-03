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
    <div class="bg-white shadow rounded p-5 border border-gray-200 flex">

        <div class="space-y-2">
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
            <div class="text-sm text-gray-700">
                <!-- Document Type -->
                Document: 
                @if($sale->documentType() == 'invoice')
                    <span>
                    {{ __('Invoice') }}: <a class="link" href="{{ route('contact.show', $sale->contact) }}">{{ $sale->contact->name }}, {{ $sale->contact->identification_number }}</a>
                    </span>
                @elseif($sale->documentType() == 'receipt')
                    <span>
                        {{ __('Receipt') }}: {{  $sale->is_receipt_printed ? __('Printed') : __('Not printed') }}
                    </span>
                @elseif($sale->documentType() == 'receipt_nip')
                    <span>
                        {{ __('Receipt NIP') }}: {{ $sale->nip_number }}, {{  $sale->is_receipt_printed ? __('Printed') : __('Not printed') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="ml-auto flex space-x-2 items-center">
            <div class="flex ml-auto">
                @if ($sale->documentType() == 'receipt' && !$sale->is_receipt_printed)
                            <x-danger-button>{{ __('Print Receipt') }}</x-danger-button>
                @elseif ($sale->documentType() == 'invoice')
                            <x-button class="ml-2">{{ __('Print Invoice') }}</x-button>
                @elseif ($sale->documentType() == 'receipt_nip' && !$sale->is_receipt_printed)
                            <x-danger-button>{{ __('Print Receipt NIP') }}</x-danger-button>
                @endif
            </div>    
            <!-- Total -->
            <p class="text-lg font-bold text-green-600 mx-auto">
                {{ __('Price') }}: {{ $sale->totalPrice() }}
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