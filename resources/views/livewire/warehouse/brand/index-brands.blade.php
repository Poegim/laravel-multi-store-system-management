<div>

    <div class="w-full flex justify-end my-1 sm:my-4 h-9 space-x-2 pr-2 sm:pr-0">
        <x-input id="name" type="text" aria-placeholder="Search..." placeholder="Search..."
            wire:model.debounce.500ms.live="search" />
        @livewire('warehouse.brand.create-brand')
    </div>

    <x-window>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex cursor-pointer" wire:click="sortBy('id')">
                            <span class="uppercase">
                                {{__('id')}}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="size-4 {{ $sortField === 'id' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex cursor-pointer" wire:click="sortBy('name')">
                            <span class="uppercase">
                                {{__('name')}}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="size-4 {{ $sortField === 'name' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 hidden md:table-cell">
                        {{__('items_count')}}
                    </th>
                    <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                        {{__('slug')}}
                    </th>
                    <th scope="col" class="px-6 py-3 text-right">

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <th scope="row" class="font-thin px-6 py-1 text-gray-800 whitespace-nowrap dark:text-white">
                        {{$brand->id}}
                    </th>
                    <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex link">
                            <a href="{{ route('brand.show', $brand->slug) }}" class="my-auto">{{$brand->name}}</a>
                        </div>
                    </th>
                    <td class="px-6 py-1 hidden lg:table-cell">
                        {{$brand->stock_items_count}}
                    </td>
                    <td class="px-6 py-1 hidden lg:table-cell">
                        {{$brand->slug}}
                    </td>
                    <td class="px-6 py-1 flex justify-end">
                        {{-- @livewire('warehouse.brand.edit-brand', ['brand' => $brand], key($brand->id), ['preserveScroll' => true]) --}}
                        {{-- <livewire:warehouse.brand.edit-brand :brand="$brand"> --}}
                        <x-buttons.edit-button wire:click="edit({{ $brand }})">
                            Edit
                        </x-buttons.edit-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <div class=" m-4">
            {{ $brands->links() }}
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
