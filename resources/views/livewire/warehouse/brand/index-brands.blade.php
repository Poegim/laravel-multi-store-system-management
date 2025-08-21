<div>

    <div class="index-create-btn-div">
        <x-input id="name" type="text" aria-placeholder="Search..." placeholder="Search..."
            wire:model.debounce.500ms.live="search" />
        @livewire('warehouse.brand.create-brand')
    </div>

<x-window>
    <div class="overflow-x-auto">
        <table class="rounded overflow-hidden min-w-full text-xs text-left text-gray-700 dark:text-gray-300 border dark:border-gray-700">
            <thead class="uppercase bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('id')">
                        ID
                        <x-sort-icon field="id" :sortField="$sortField" :sortAsc="$sortAsc" />
                    </th>
                    <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('name')">
                        {{ __('name') }}
                        <x-sort-icon field="name" :sortField="$sortField" :sortAsc="$sortAsc" />
                    </th>
                    <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('stock_items_count')">
                        <span class="hidden lg:inline">{{ __('stock_items_count') }}</span>
                        <span class="lg:hidden">{{ __('stock') }}</span>
                        <x-sort-icon field="stock_items_count" :sortField="$sortField" :sortAsc="$sortAsc" />
                    </th>
                    <th class="px-4 py-2 hidden lg:table-cell">{{ __('slug') }}</th>
                    <th class="px-4 py-2 hidden lg:table-cell">{{ __('created_by') }}</th>
                    <th class="px-2 py-2 text-right"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr class="bg-white dark:bg-gray-800 border-t hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <td class="px-4 py-2 text-gray-900 dark:text-white">{{ $brand->id }}</td>
                    <td class="px-4 py-2 font-medium text-gray-900 dark:text-white">
                        <a href="{{ route('brand.show', $brand->slug) }}" class="link">{{ $brand->name }}</a>
                    </td>
                    <td class="px-4 py-2">{{ $brand->stock_items_count }}</td>
                    <td class="px-4 py-2 hidden lg:table-cell">{{ $brand->slug }}</td>
                    <td class="px-4 py-2 hidden lg:table-cell">
                        <div class="flex items-center gap-2">
                            <img src="{{ $brand->user->profile_photo_url }}" alt="{{ $brand->user->name }}"
                                class="rounded-full w-6 h-6 object-cover">
                            <span>{{ $brand->user->name }}</span>
                        </div>
                    </td>
                    <td class="px-2 py-2 text-right">
                        <x-buttons.edit-button wire:click="edit({{ $brand }})">
                            {{ __('Edit') }}
                        </x-buttons.edit-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="m-4">
        {{ $brands->links(data: ['scrollTo' => false]) }}
    </div>
</x-window>



    <!-- Show Edit Modal -->
    <x-dialog-modal wire:model.live="modalVisibility">
        <x-slot name="title">
            {{ __('Edit') }}: {{$brand?->name}}
        </x-slot>

        <x-slot name="content">

            @if ($errors->any())
            <x-lists.errors-list>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </x-lists.errors-list>
            @endif

            <div class="mt-4 p-4 rounded-mid  border border-gray-200 dark:border-gray-700">

                <label for="name" class="input-label">{{__('name')}}</label>
                @error('name')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                <input wire:model.live="name" type="text" id="name" class="input-text" required value="{{$name}}" />

                <label for="slug" class="input-label">{{__('slug')}}</label>
                @error('slug')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror
                <input wire:model="slug" type="text" id="slug" class="input-text" required value="{{$slug}}" disabled />

            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalVisibility')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-danger-button class="ms-3" wire:click="update()">
                {{ __('Update') }}
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>


</div>
