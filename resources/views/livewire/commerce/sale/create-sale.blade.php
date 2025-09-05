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
            class="border border-gray-300 p-1 rounded text-sm" 
            type="text" placeholder="{{ __('Search for a item') }}" 
            wire:model="searchItem" 
            wire:keydown.enter="addItem"
            />
            <button 
                class="bg-blue-500 text-white text-sm p-1 px-2 rounded" 
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
        <div class="text-sm text-gray-800 grid grid-cols-3 gap-2">
            <div class="bg-white shadow-md rounded p-4 border border-gray-200">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Sale summary</h2>

                <dl class="space-y-3">
                    <!-- Items count -->
                    <div class="flex justify-between text-gray-700">
                        <dt class="font-medium">Items count</dt>
                        <dd>{{ $saleItems->count() }}</dd>
                    </div>

                    <!-- Cost of purchase NET -->
                    <div class="flex justify-between text-gray-700">
                        <dt class="font-medium">Cost of purchase NET</dt>
                        <dd>{{ number_format($totalPurchaseNet / 100, 2, '.', ' ') }}</dd>
                    </div>

                    <!-- Cost of purchase GROSS -->
                    <div class="flex justify-between text-gray-700">
                        <dt class="font-medium">Cost of purchase GROSS</dt>
                        <dd>{{ number_format($totalPurchaseGross / 100, 2, '.', ' ') }}</dd>
                    </div>

                    <!-- Gross profit -->
                    <div class="flex justify-between">
                        <dt class="font-medium text-gray-700">Gross profit</dt>
                        <dd class="font-bold {{ $totalSoldPrice - $totalPurchaseGross < 0 ? 'text-red-600' : 'text-green-600' }}">
                            {{ number_format(($totalSoldPrice - $totalPurchaseGross) / 100, 2, '.', ' ') }}
                        </dd>
                    </div>

                    <!-- Total price -->
                    <div class="flex justify-between border-t border-gray-200 pt-3">
                        <dt class="font-semibold text-gray-900">Total price</dt>
                        <dd class="font-bold text-gray-900">
                            {{ number_format($totalSoldPrice / 100, 2, '.', ' ') }}
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white shadow-md rounded p-4 border border-gray-200">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Document type: {{ $receiptType }}</h2>
                <div class="2xl:grid grid-cols-2 gap-2">
                    <div>
                        <select wire:model.live="receiptType" class="input-text min-w-36">
                            <option value="receipt">{{ __('Receipt') }}</option>
                            <option value="receipt_nip">{{ __('Receipt with NIP')}}</option>
                            <option value="invoice">{{ __('Invoice') }}</option>
                        </select>
                    </div>
                    @if($receiptType === 'invoice')
                    <div>
                        <select wire:model.live="contactType" class="input-text min-w-28">
                            <option value="1">{{ __('Customer') }}</option>
                            <option value="2">{{ __('Company')}}</option>
                        </select>
                    </div>

                    <div>
                        <div class="relative" x-data="{ open: false }">
                            <!-- input that toggles the dropdown -->
                            <input 
                            type="text" wire:model.live="searchContact"
                                @click="open = !open" 
                                class="border p-2 w-full input-text"
                                placeholder="Search..."
                            >

                            <!-- dropdown list -->
                            <div 
                                x-show="open" 
                                @click.outside="open = false"
                                x-transition
                                class="absolute z-10 border border-gray-300 rounded max-h-48 overflow-y-auto mt-1 bg-white w-full shadow-lg"
                            >
                                @foreach ($contacts as $contact)
                                    <div 
                                        class="p-1 hover:bg-gray-200 cursor-pointer"
                                        @click="open = false; $wire.selectContact({{ $contact->id }})"
                                    >
                                        [{{$contact->type()}}] {{ $contact->name }} ({{ $contact->identification_number }})
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if($selectedContact != null)
                    <div>
                        <p class="text-xs font-bold">Selected Contact: {{$selectedContact->name}}</p>
                        <p class="text-xs">Contact Type: {{$selectedContact->type()}}</p>
                        <p class="text-xs">Identification Number: {{$selectedContact->identification_number}}</p>
                    </div>
                    @endif
                    @endif
                    @if($receiptType === 'receipt_nip')
                    <div>
                        <input 
                            type="text" 
                            wire:model.live="nipNumber" 
                            class="input-text" 
                            placeholder="{{ __('NIP Number') }}"
                        >
                    </div>
                    @endif
                </div>
            </div>
            <div class="flex justify-end">
                @if($sale->stockItems->count() > 0)
                <button 
                    class="bg-green-600 hover:bg-green-700 active:bg-green-800 
                           text-white font-semibold text-sm md:text-base 
                           px-4 py-2 rounded shadow-md hover:shadow-lg 
                           transition-all duration-200 ease-in-out flex items-center gap-2"
                    wire:click="showFinalizeSaleModal"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z"/>
                    </svg>
                    {{ __('Finalize Sale') }}
                </button>
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
                    <th scope="col" class="p-2">{{ __('Remove') }}</th>
                    <th scope="col" class="p-2">{{ __('Final Price') }}</th>
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
                        {{ $saleItem->formattedSRP() }}
                    </td>
                    <td class="p-2">
                            <button class="flex gap-1 hover:fill-red-500 text-red-600 hover:text-red-900" wire:click="removeItem({{ $saleItem->id }})" wire:click="removeItem({{ $saleItem }})">
                                <svg fill="#currentColor" class="size-6" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>remove</title> <path d="M11.188 4.781c6.188 0 11.219 5.031 11.219 11.219s-5.031 11.188-11.219 11.188-11.188-5-11.188-11.188 5-11.219 11.188-11.219zM11.25 17.625l3.563 3.594c0.438 0.438 1.156 0.438 1.594 0 0.406-0.406 0.406-1.125 0-1.563l-3.563-3.594 3.563-3.594c0.406-0.438 0.406-1.156 0-1.563-0.438-0.438-1.156-0.438-1.594 0l-3.563 3.594-3.563-3.594c-0.438-0.438-1.156-0.438-1.594 0-0.406 0.406-0.406 1.125 0 1.563l3.563 3.594-3.563 3.594c-0.406 0.438-0.406 1.156 0 1.563 0.438 0.438 1.156 0.438 1.594 0z"></path> </g></svg>
                                <div class="my-auto">
                                    {{ __('Remove') }}
                                </div>
                            </button>
                    </td>
                    <td class="p-2 font-semibold {{ $saleItem->pivot->price < $saleItem->purchase_price_gross ? 'text-red-600' : '' }} {{ $saleItem->pivot->price > $saleItem->purchase_price_gross ? 'text-green-600' : '' }}">
                        {{ number_format($saleItem->pivot->price / 100, 2, '.', ' ') }}
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
            Edit {{ $editedItem?->id }} - {{ $editedItem?->productVariant->product->name }} - {{ $editedItem?->productVariant->name }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                {{ $editedPrice }}
                <x-input type="number" min="0.01" max="100000" class="mt-1 block w-3/4"
                            wire:model="editedPrice" />
                <x-input-error for="editedPrice" class="mt-2" />
            </div>
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

    <x-dialog-modal wire:model.live="finalizeSaleModal">
        <x-slot name="title">
            {{ __('Finalize Sale') }}: {{$sale?->store?->name}} {{ $sale?->id }}
        </x-slot>

        <x-slot name="content">
            @if($errors->any())
            <x-lists.errors-list title="{{ __('Errors detected!') }}">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </x-lists.errors-list>
            @endif

            <div class="bg-white shadow-md rounded p-4 border border-gray-200">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Sale summary</h2>

                <dl class="space-y-3">
                    <!-- Items count -->
                    <div class="flex justify-between text-gray-700">
                        <dt class="font-medium">Items count</dt>
                        <dd>{{ $saleItems->count() }}</dd>
                    </div>

                    <!-- Cost of purchase NET -->
                    <div class="flex justify-between text-gray-700">
                        <dt class="font-medium">Cost of purchase NET</dt>
                        <dd>{{ number_format($totalPurchaseNet / 100, 2, '.', ' ') }}</dd>
                    </div>

                    <!-- Cost of purchase GROSS -->
                    <div class="flex justify-between text-gray-700">
                        <dt class="font-medium">Cost of purchase GROSS</dt>
                        <dd>{{ number_format($totalPurchaseGross / 100, 2, '.', ' ') }}</dd>
                    </div>

                    <!-- Gross profit -->
                    <div class="flex justify-between">
                        <dt class="font-medium text-gray-700">Gross profit</dt>
                        <dd class="font-bold {{ $totalSoldPrice - $totalPurchaseGross < 0 ? 'text-red-600' : 'text-green-600' }}">
                            {{ number_format(($totalSoldPrice - $totalPurchaseGross) / 100, 2, '.', ' ') }}
                        </dd>
                    </div>

                    <!-- Total price -->
                    <div class="flex justify-between border-t border-gray-200 pt-3">
                        <dt class="font-semibold text-gray-900">Total price</dt>
                        <dd class="font-bold text-gray-900">
                            {{ number_format($totalSoldPrice / 100, 2, '.', ' ') }}
                        </dd>
                    </div>
                </dl>
            </div>
            
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('finalizeSaleModal')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="finalizeSale" wire:loading.attr="disabled">
                {{ __('Finalize') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>



</div>
