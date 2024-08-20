<div class="py-2 sm:py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="w-full flex justify-end my-4 h-9 space-x-2">
            <x-input id="name" type="text" aria-placeholder="Search..." placeholder="Search..." wire:model.debounce.500ms.live="search" />
            {{-- <@livewire('warehouse.product.create-product') --}}
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex cursor-pointer" wire:click="sortBy('id')">
                                    <span class="uppercase">
                                        {{__('id')}}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-4 {{ $sortField === 'id' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex cursor-pointer" wire:click="sortBy('name')">
                                    <span class="uppercase" >
                                        {{__('name')}}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="size-4 {{ $sortField === 'name' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                                {{__('slug')}}
                            </th>
                            <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                                {{__('category')}}
                            </th>
                            <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                                {{__('brand')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right">
                                {{__('action')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $item)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700" wire:key="row-{{ $item->id }}">
                            <td class="px-6 py-2">
                               {{$item->id}}
                            </td>
                            <td scope="row"
                                class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex">
                                    <a href="#" class="my-auto" alt="{{$item->name}}" label="{{$item->name}}">{{Illuminate\Support\Str::limit($item->name, 30, '...')}}</a>
                                </div>
                            </td>
                            <td class="px-6 py-2 hidden lg:table-cell">
                                {{$item->slug}}
                            </td>
                            <td class="px-6 py-2 hidden lg:table-cell">
                                {{$item->category->plural_name}}
                            </td>
                            <td class="px-6 py-2 hidden lg:table-cell">
                                {{$item->brand->name}}
                            </td>
                            <td class="px-6 py-2 flex justify-end">
                                <x-buttons.edit-button wire:click="edit({{ $item->id }})">
                                    Edit
                                </x-buttons.edit-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class=" m-4">
                {{ $products->links() }}
            </div>
        </div>

    </div>

    <!-- Show Edit Modal -->
    <x-dialog-modal wire:model.live="modalVisibility">
        <x-slot name="title">
            {{ __('Edit') }}: {{$product?->name}}
        </x-slot>

        <x-slot name="content">

            @if ($errors->any())
            <x-lists.errors-list>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </x-lists.errors-list>
            @endif

            <div class="mt-4 p-4 rounded-lg border border-gray-200 dark:border-gray-700">

                <label for="name"
                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('name')}}</label>
                @error('name')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                <input wire:model.live="name" type="text" id="name"
                    class="mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required value="{{$name}}" />

                <label for="slug" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('slug')}}</label>
                @error('slug')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror
                <input wire:model="slug" type="text" id="slug"
                class="mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                required value="{{$slug}}" disabled/>

                @php
                    function renderCategoryOptions($categories, $level = 0) {
                        foreach ($categories as $category) {
                            echo '<option value="' . $category['id'] . '" class="ml-' . ($level * 2) . '">';
                            echo str_repeat('&nbsp;', $level * 2) . $category['plural_name'];
                            echo '</option>';
                            if (array_key_exists('children', $category)) {
                                renderCategoryOptions($category['children'], $level + 1);
                            }
                        }
                    }
                @endphp

                <label for="category"
                class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('category')}}</label>
                @error('category')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror
                <select class="w-full rounded-lg border border-blue-300 mb-4" wire:model="category_id">
                    @php
                        renderCategoryOptions($categories);
                    @endphp
                </select>

                <label for="brand"
                class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('brand')}}
                </label>
                @error('brand')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                <div class="w-full rounded-t-lg border-t border-l border-r border-gray-200 text-xs px-2 py-1">
                    Selected: {{$brand?->name}} ID: [{{$brand_id}}]
                    <div wire:loading wire:target="brand_id" class="bg-green-300 px-4">
                        Changing...
                    </div>
                </div>

                <livewire:search-dropdown wire:model.debounce.500ms.live="brand_id" :collection="$brands" />


                @error('is_device')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                <div class="flex space-x-2 mt-4">
                    <input wire:model.live="is_device" type="checkbox" id="is_device"
                    class="mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required value="{{$is_device}}" />
                    <label for="is_device"
                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('is_device')}}</label>
                </div>

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
