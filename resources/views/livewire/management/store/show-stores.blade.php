<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full flex justify-end my-4">
            <x-button >
                <a href="#" class="flex">
                    <x-fas-plus class="w-6 h-6 mr-2"/>
                    <span class="my-auto">
                        {{ __('CREATE') }}
                    </span>
                </a>
            </x-button>
        </div>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stores as $item)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <th scope="row"
                                class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{route('store.show', $item)}}">{{$item->name}}</a>
                            </th>
                            <td class="px-6 py-2">
                                {{$item->email}}
                            </td>
                            <td class="px-6 py-2">
                                <button wire:click="edit({{ $item->id }})" class="text-indigo-500 dark:hover:text-indigo-300 hover:text-indigo-700 transition-colors duration-300">
                                    <x-fas-edit class="h-6 w-6"/>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Show User Modal -->
    <x-dialog-modal wire:model.live="showEditModal">
        <x-slot name="title">
            {{ __('Edit store') }}: {{ $store?->name }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4" x-data="{ activeTab: 'A' }">
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                    <li>
                        <x-buttons.flowbite.default class="rounded-t-lg" x-on:click="activeTab = 'A'" x-bind:class="{ 'bg-indigo-500 dark:bg-indigo-500 ': activeTab === 'A', 'bg-indigo-700 dark:bg-indigo-700 ': activeTab === 'B' }"> 
                        Basic
                        </x-buttons.flowbite.default>
                    </li>
                    <li>
                        <x-buttons.flowbite.default class="rounded-t-lg" x-on:click="activeTab = 'B'" x-bind:class="{ 'bg-indigo-500 dark:bg-indigo-500': activeTab === 'B', 'bg-indigo-700 dark:bg-indigo-700 ': activeTab === 'A' }"> 
                        Advanced
                        </x-buttons.flowbite.default>
                    </li>
                </ul>

                <div x-show="activeTab === 'A'" class="w-full rounded-b p-4 border-2 border-indigo-500">

                    <div class="mb-4">
                        
                        <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input 
                            wire:model="name" 
                            type="name" 
                            id="name" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$store?->name}}" 
                        />

                        <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input 
                            wire:model="email" 
                            type="email" 
                            id="email" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$store?->email}}" 
                        />

                        <label for="phone" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                        <input 
                            wire:model="phone" 
                            type="text" 
                            id="phone" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$store?->phone}}"
                        />

                        <label for="city" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">City</label>
                        <input 
                            wire:model="city" 
                            type="text" 
                            id="city" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$store?->city}}"
                        />

                        <label for="postcode" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Post code</label>
                        <input 
                            wire:model="postcode" 
                            type="text" 
                            id="postcode" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$store?->postcode}}"
                        />

                        <label for="street" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Street</label>
                        <input 
                            wire:model="street" 
                            type="text" 
                            id="street" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$store?->street}}"
                        />

                        <label for="building_number" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Building number</label>
                        <input 
                            wire:model="building_number" 
                            type="text" 
                            id="building_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$store?->building_number}}"
                        />

                        <label for="apartment_number" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Apartment number</label>
                        <input 
                            wire:model="apartment_number" 
                            type="text" 
                            id="apartment_number" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$store?->apartment_number}}"
                        />

                        <x-color-picker name="color" />
                        
                    </div>
    
                </div>

                <div x-show="activeTab === 'B'" class="w-full rounded-b p-4 border-2 border-indigo-500">
                                    
                    <div class="mb-4">
                        <label for="order" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">List order priority</label>
                        <input 
                            wire:model="order" 
                            type="number" 
                            id="order" 
                            class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            required 
                            value="{{$store?->order}}" 
                        />
                    </div>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showEditModal')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="update">
                {{ __('Update') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>