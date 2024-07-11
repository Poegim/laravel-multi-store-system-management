<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="w-full flex justify-end my-4">
            <x-buttons.flowbite.cyan-to-blue>
                <div class="flex">
                    <span class="my-auto">
                        {{ __('CREATE') }}
                    </span>
                </div>
            </x-buttons.flowbite.cyan-to-blue>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

            <div class="relative overflow-x-auto">
                <div class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <div class="w-full">
                        <div class="bg-white dark:bg-gray-800 grid grid-cols-1 md:grid-cols-3">
                            <div
                                class="px-6 py-3 uppercase md:hidden text-center text-2xl font-bold text-black dark:text-white">
                                {{__('users list')}}
                            </div>
                            <div class="px-6 py-3 uppercase hidden md:block text-left"">
                                {{__('name')}}
                            </div>
                            <div  class=" px-6 py-3 uppercase hidden md:block text-left">
                                {{__('email')}}
                            </div>
                            <div class="px-6 py-3 uppercase hidden md:block text-right">
                                {{__('action')}}
                            </div>
                        </div>

                        @foreach($users as $item)
                        <div class="bg-white dark:bg-gray-800 grid grid-cols-1 md:grid-cols-3 md:hover:bg-gray-200 dark:md:hover:bg-gray-600 rounded-lg md:rounded-none p-4 md:p-0 m-4 md:m-0 border border-1 border-gray-200 md:border-0">
                            <div
                                class="px-6 py-1 font-medium text-center items-center md:place-items-start text-gray-900 whitespace-nowrap dark:text-white flex flex-col md:flex-row md:text-left justify-center md:justify-start">
                                <img src="{{ $item->profile_photo_url }}" alt="{{ $item->name }}"
                                    class="rounded-full w-12 h-12 md:h-10 md:w-10 object-cover mr-2 my-auto mb-4 md:mb-0">
                                <div class="my-auto text-xl md:text-sm">{{$item->name}}</div>
                            </div>
                            <div class="px-6 py-1 text-center md:text-left my-auto">
                                {{$item->email}}
                            </div>
                            <div class="px-6 py-1 text-right my-auto flex justify-center md:justify-end">
                                <x-buttons.edit-button wire:click="edit({{ $item->id }})" class="hidden md:block" />
                                <x-button wire:click="edit({{ $item->id }})"
                                    class="block md:hidden bg-gradient-to-tr from-indigo-600 to-green-600 dark:from-indigo-400 dark:to-green-400">
                                    Edit</x-button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
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
                        <x-buttons.flowbite.default class="rounded-t-lg bg-gradient-to-tr" x-on:click="activeTab = 'A'"
                            x-bind:class="{ 'active-tab': activeTab === 'A', 'inactive-tab': activeTab != 'A' }">
                            <a href="#">{{__('User details')}}</a>
                        </x-buttons.flowbite.default>
                    </li>
                    <li>
                        <x-buttons.flowbite.default class="rounded-t-lg bg-gradient-to-tr" x-on:click="activeTab = 'B'"
                            x-bind:class="{ 'active-tab': activeTab === 'B', 'inactive-tab': activeTab != 'B' }">
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
