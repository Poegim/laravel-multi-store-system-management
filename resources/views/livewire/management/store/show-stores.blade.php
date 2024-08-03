<div class="py-2 sm:py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="w-full flex justify-end my-4">
            <x-button wire:click="create()">
                {{ __('CREATE') }}
            </x-button>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{__('name')}}
                            </th>
                            <th scope="col" class="px-6 py-3 hidden md:table-cell">
                            {{__('email')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('action')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stores as $item)

                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <th scope="row"
                                class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex">
                                    <div style="background-color:{{$item->color->value}};" class="h-8 w-8 my-auto rounded-full"></div>
                                    <a href="{{route('store.show', $item)}}" class="my-auto ml-2">{{$item->name}}</a>
                                </div>
                            </th>
                            <td class="px-6 py-2 hidden md:table-cell">
                                {{$item->email}}
                            </td>
                            <td class="px-6 py-2">
                                <x-buttons.edit-button wire:click="edit({{ $item->id }})">
                                    Edit
                                </x-buttons.edit-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Show Edit Modal -->
    <x-dialog-modal wire:model.live="modalVisibility">
        <x-slot name="title">
            @if ($actionType === 'edit')
            {{ __('Edit store') }}: {{ $name }}
            @elseif ($actionType === 'create')
            {{ __('Create store') }}
            @endif
        </x-slot>

        <x-slot name="content">

            @if ($errors->any())
                <x-lists.errors-list >
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                </x-lists.errors-list >
            @endif

            <div class="mt-4" x-data="{ activeTab: $wire.entangle('activeModalTab') }">
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                    <li>
                        <x-buttons.flowbite.default class="rounded-t-lg bg-gradient-to-tr" x-on:click="activeTab = 'A'" x-bind:class="{ 'active-tab ': activeTab === 'A', 'inactive-tab': activeTab != 'A' }"> 
                        {{__('basic')}}
                        </x-buttons.flowbite.default>
                    </li>
                    <li>
                        <x-buttons.flowbite.default class="rounded-t-lg bg-gradient-to-tr" x-on:click="activeTab = 'B'" x-bind:class="{ 'active-tab': activeTab === 'B', 'inactive-tab': activeTab != 'B' }"> 
                        {{__('address')}}
                        </x-buttons.flowbite.default>
                    </li>
                    <li>
                        <x-buttons.flowbite.default class="rounded-t-lg bg-gradient-to-tr" x-on:click="activeTab = 'C'" x-bind:class="{ 'active-tab': activeTab === 'C', 'inactive-tab': activeTab != 'C' }"> 
                        {{__('prefixes')}}
                        </x-buttons.flowbite.default>
                    </li>
                    <li>
                        <x-buttons.flowbite.default class="rounded-t-lg bg-gradient-to-tr" x-on:click="activeTab = 'D'" x-bind:class="{ 'active-tab': activeTab === 'D', 'inactive-tab': activeTab != 'D' }"> 
                        {{__('indexes')}}
                        </x-buttons.flowbite.default>
                    </li>
                </ul>

                <div x-show="activeTab === 'A'" class="w-full rounded-b p-4 border-2 border-indigo-400">

                    <!-- Basic tab -->
                    <div class="mb-4">
                        
                        <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('name')}}</label>
                        @error('name')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="name" 
                            type="name" 
                            id="name" 
                            class="mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$name}}" 
                        />

                        <label for="order" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{ __('order')}}</label>
                        @error('order')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="order" 
                            type="number" 
                            id="order" 
                            class="mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$order}}" 
                        />

                        <label for="color_id" class="block mb-2 text-sm font-medium text-gray-700">Select color:</label>
                        @error('color_id')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                           
                        <select id="color_id"
                            wire:model="color_id" 
                            class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @foreach ($colors as $color)
                            <option style="background-color: {{$color->value}} ;" value="{{$color->id}}">{{ $color->name }}</option>
                            @endforeach
                        </select>

                        <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('email')}}</label>
                        @error('email')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="email" 
                            type="email" 
                            id="email" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$email}}" 
                        />

                        <label for="phone" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('phone')}}</label>
                        @error('phone')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="phone" 
                            type="text" 
                            id="phone" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$phone}}"
                        />

                    </div>
    
                </div>

                
                <!-- Address tab -->
                <div x-show="activeTab === 'B'" class="w-full rounded-b p-4 border-2 border-indigo-400">
                                    
                    <div class="mb-4">
                        <label for="city" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('city')}}</label>
                        @error('city')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="city" 
                            type="text" 
                            id="city" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$city}}"
                        />

                        <label for="postcode" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('postcode')}}</label>
                        @error('postcode')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="postcode" 
                            type="text" 
                            id="postcode" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$postcode}}"
                        />

                        <label for="street" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('street')}}</label>
                        @error('street')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="street" 
                            type="text" 
                            id="street" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$street}}"
                        />

                        <label for="building_number" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('building_number')}}</label>
                        @error('building_number')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="building_number" 
                            type="text" 
                            id="building_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$building_number}}"
                        />

                        <label for="apartment_number" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('apartment_number')}}</label>
                        @error('apartment_number')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="apartment_number" 
                            type="text" 
                            id="apartment_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$apartment_number}}"
                        />

                    </div>
                </div>

                <!-- Prefixes tab -->
                <div x-show="activeTab === 'C'" class="w-full rounded-b p-4 border-2 border-indigo-400">
                                    
                    <div class="mb-4">

                        <label for="contracts_prefix" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('contracts_prefix')}}</label>
                        @error('contracts_prefix')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="contracts_prefix" 
                            type="text" 
                            id="building_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$contracts_prefix}}"
                        />

                        <label for="invoices_prefix" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('invoices_prefix')}}</label>
                        @error('invoices_prefix')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="invoices_prefix" 
                            type="text" 
                            id="building_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$invoices_prefix}}"
                        />

                        <label for="margin_invoices_prefix" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('margin_invoices_prefix')}}</label>
                        @error('margin_invoices_prefix')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="margin_invoices_prefix" 
                            type="text" 
                            id="building_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$margin_invoices_prefix}}"
                        />

                        <label for="proforma_invoices_prefix" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('proforma_invoices_prefix')}}</label>
                        @error('proforma_invoices_prefix')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="proforma_invoices_prefix" 
                            type="text" 
                            id="building_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$proforma_invoices_prefix}}"
                        />

                        <label for="internal_servicing_prefix" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('internal_servicing_prefix')}}</label>
                        @error('internal_servicing_prefix')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="internal_servicing_prefix" 
                            type="text" 
                            id="building_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$internal_servicing_prefix}}"
                        />

                        <label for="external_servicing_prefix" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('external_servicing_prefix')}}</label>
                        @error('external_servicing_prefix')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="external_servicing_prefix" 
                            type="text" 
                            id="building_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$external_servicing_prefix}}"
                        />

                    </div>
                </div>

                <!-- Indexes tab -->
                <div x-show="activeTab === 'D'" class="w-full rounded-b p-4 border-2 border-indigo-400">
                                    
                    <div class="mb-4">

                        <label for="next_receipt_number" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('next_receipt_number')}}</label>
                        @error('next_receipt_number')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="next_receipt_number" 
                            type="number" 
                            id="building_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$next_receipt_number}}"
                        />

                        <label for="next_invoice_number" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('next_invoice_number')}}</label>
                        @error('next_invoice_number')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="next_invoice_number" 
                            type="number" 
                            id="building_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$next_invoice_number}}"
                        />

                        <label for="next_margin_invoice_number" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('next_margin_invoice_number')}}</label>
                        @error('next_margin_invoice_number')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="next_margin_invoice_number" 
                            type="number" 
                            id="building_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$next_margin_invoice_number}}"
                        />

                        <label for="next_proforma_invoice_number" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('next_proforma_invoice_number')}}</label>
                        @error('next_proforma_invoice_number')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="next_proforma_invoice_number" 
                            type="number" 
                            id="building_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$next_proforma_invoice_number}}"
                        />

                        <label for="next_internal_servicing_number" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('next_internal_servicing_number')}}</label>
                        @error('next_internal_servicing_number')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="next_internal_servicing_number" 
                            type="number" 
                            id="building_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$next_internal_servicing_number}}"
                        />

                        <label for="next_external_servicing_number" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('next_external_servicing_number')}}</label>
                        @error('next_external_servicing_number')
                            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                        @enderror
                        <input 
                            wire:model="next_external_servicing_number" 
                            type="number" 
                            id="building_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$next_external_servicing_number}}"
                        />

                    </div>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalVisibility')">
                {{ __('Cancel') }}
            </x-secondary-button>

            @if ($actionType === 'create')
            
            <x-danger-button class="ms-3" wire:click="storeModel()">
                {{ __('Create') }}
            </x-danger-button> 

            @elseif ($actionType === 'edit')                
            
            <x-danger-button class="ms-3" wire:click="update({{$store?->id}})">
                {{ __('Update') }}
            </x-danger-button>
            
            @endif
        </x-slot>
    </x-dialog-modal>

</div>