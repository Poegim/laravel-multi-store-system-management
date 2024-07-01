<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="w-full flex justify-end my-4">
            <x-buttons.flowbite.cyan-to-blue >
                <div class="flex">
                    <x-fas-plus class="w-6 h-6 mr-2"/>
                    <span class="my-auto">
                        {{ __('CREATE') }}
                    </span>
                </div>
            </x-buttons.flowbite.cyan-to-blue>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{__('name')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                            {{__('email')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('action')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $item)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <th scope="row"
                                class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$item->name}}
                            </th>
                            <td class="px-6 py-2">
                                {{$item->email}}
                            </td>
                            <td class="px-6 py-2">
                                <x-buttons.edit-button wire:click="edit({{ $item->id }})" >
                                    <x-fas-edit class="h-6 w-6"/>
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
    <x-dialog-modal wire:model.live="showEditModal">
        <x-slot name="title">
            {{ __('Edit Account') }}: {{ $user?->name }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4" x-data="{ activeTab: 'A' }">
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                    <li>
                        <x-buttons.flowbite.default class="rounded-t-lg bg-gradient-to-tr" x-on:click="activeTab = 'A'" x-bind:class="{ 'active-tab': activeTab === 'A', 'inactive-tab': activeTab != 'A' }"> 
                            <a href="#">{{__('User details')}}</a>
                        </x-buttons.flowbite.default>
                    </li>
                    <li>
                        <x-buttons.flowbite.default class="rounded-t-lg bg-gradient-to-tr" x-on:click="activeTab = 'B'" x-bind:class="{ 'active-tab': activeTab === 'B', 'inactive-tab': activeTab != 'B' }"> 
                            <a href="#">{{__('Access levels')}}</a>
                        </x-buttons.flowbite.default>
                    </li>
                </ul>

                <div x-show="activeTab === 'A'" class="w-full rounded-b py-2 px-1 border-2 border-indigo-400">
                    <p>User details</p>
                </div>
    
                <div x-show="activeTab === 'B'" class="w-full rounded-b py-2 px-1 border-2 border-indigo-400">
                    <p>{{__('Access levels')}}</p>
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