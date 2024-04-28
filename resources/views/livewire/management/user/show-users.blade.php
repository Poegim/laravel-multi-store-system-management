<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                        @foreach($users as $item)
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$item->name}}
                            </th>
                            <td class="px-6 py-4">
                                {{$item->email}}
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="edit({{ $item->id }})">Edit</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Show User Modal -->
    <x-dialog-modal wire:model.live="showUserModal">
        <x-slot name="title">
            {{ __('Edit Account') }}: {{ $user?->name }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4" x-data="{ activeTab: 'A' }">
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                    <li>
                        <x-buttons.flowbite.default x-on:click="activeTab = 'A'" x-bind:class="{ 'dark:bg-blue-800': activeTab === 'A' }"> 
                            <a href="#">User details</a>
                        </x-buttons.flowbite.default>
                    </li>
                    <li>
                        <x-buttons.flowbite.default x-on:click="activeTab = 'B'" x-bind:class="{ 'dark:bg-blue-800': activeTab === 'B' }"> 
                            <a href="#">Access levels</a>
                        </x-buttons.flowbite.default>
                    </li>
                </ul>

                <div x-show="activeTab === 'A'" class="w-full rounded py-2 px-1 border border-1 border-gray-400">
                    <p>User details</p>
                </div>
    
                <div x-show="activeTab === 'B'" class="w-full rounded py-2 px-1 border border-1 border-gray-400">
                    <p>Access levels</p>
                </div>
            </div>


        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showUserModal')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="update">
                {{ __('Update') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>