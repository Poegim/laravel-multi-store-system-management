<div>
        <div class="index-create-btn-div">
            <x-button wire:click="create()">
                {{ __('CREATE') }}
            </x-button>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl">
            <div class="p-2 rounded-md shadow-lg">
                <div class="-ml-12">
                    @foreach ($categories as $categoryName => $category)
                        @include('livewire.warehouse.category.list', ['name' => $categoryName, 'category' => $category,
                        'parent' => null])
                    @endforeach
                </div>
            </div>
    </div>

    <!-- Show Edit Modal -->
    <x-dialog-modal wire:model.live="modalVisibility">
        <x-slot name="title">
            @if ($actionType === 'edit')
            {{ __('Edit category') }}: {{ $plural_name }}
            @elseif ($actionType === 'create')
            {{ __('Create category') }}
            @endif
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

                <input type="hidden" autofocus>

                <label for="plural_name"
                    class="input-label" >{{__('plural_name')}}</label>
                @error('plural_name')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror
                <input wire:model.live="plural_name" type="text" id="plural_name"
                    class="input-text"
                    required value="{{$plural_name}}" autofocus="false"/>

                <label for="slug"
                    class="input-label">{{__('slug')}}</label>
                @error('slug')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror
                <input wire:model="slug" type="text" id="slug"
                class="input-text"
                required value="{{$slug}}" disabled/>

                <label for="singular_name"
                    class="input-label">{{__('singular_name')}}</label>
                @error('singular_name')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror
                <input wire:model="singular_name" type="text" id="singular_name"
                    class="input-text"
                    required value="{{$singular_name}}" />

                @php
                    function renderCategoryOptions($categoriesSelectList, $level = 0) {
                        foreach ($categoriesSelectList as $category) {
                            if($category['disabled'] == false) {

                                echo '<option value="' . $category['id'] . '" class="ml-' . ($level * 2) . '">';
                                echo str_repeat('&nbsp;', $level * 2) . $category['plural_name'];
                                echo '</option>';
                                if (array_key_exists('children', $category)) {
                                    renderCategoryOptions($category['children'], $level + 1);
                                }
                            }
                        }
                    }
                @endphp

                <label for="category"
                class="input-label">{{__('category')}}</label>
                @error('category')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror
                <select class="w-full rounded-mid border border-blue-300 mb-4 dark:bg-slate-700 dark:text-gray200" wire:model="parent_id">
                    @php
                        renderCategoryOptions($categoriesSelectList);
                    @endphp
                </select>

                <div class="border-2 border-orange-500 dark:border-orange-300 p-2 rounded-mid ">
                    @error('disabled')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <div>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 float-left mr-2 mt-2 text-orange-500 dark:text-orange-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        {{ __('Disabled categories will not appear in select lists but will remain visible in the general listing. Setting a category to disabled will change the state of its subcategories accordingly. Conversely, enabling a subcategory will change the state of its parent category to enabled.')}}

                    </div>
                    <div class="flex my-2">
                        <input wire:model="disabled" type="checkbox" id="disabled"
                        class="my-auto border border-indigo-300 text-gray-900 text-sm rounded-mid  p-2.5 dark:bg-gray-700 dark:border-gray-600" required />
                        <label for="disabled" class="ml-2 my-auto text-sm font-medium text-gray-900 dark:text-white">{{__('disabled')}}</label>
                    </div>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalVisibility')">
                {{ __('Cancel') }}
            </x-secondary-button>

            @if ($actionType === 'create')

            <x-danger-button class="ms-3" wire:click="store()">
                {{ __('Create') }}
            </x-danger-button>

            @elseif ($actionType === 'edit')

            <x-danger-button class="ms-3" wire:click="update({{ $category['id'] ?? 'null' }})">
                {{ __('Update') }}
            </x-danger-button>

            @endif
        </x-slot>
    </x-dialog-modal>
</div>
