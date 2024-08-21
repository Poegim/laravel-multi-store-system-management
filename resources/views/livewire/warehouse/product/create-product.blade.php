<div
    x-data="{ visibleList: false, search: '' }"

    >


    <x-button wire:click="showModal('create')">
        {{ __('CREATE') }}
    </x-button>

    <!-- Show Create Modal -->
    <x-dialog-modal wire:model.live="modalVisibility">
        <x-slot name="title">
            {{ __('Create Product') }}
        </x-slot>

        <x-slot name="content">
            {{ $brand_id }}
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
                    required />

                <label for="slug" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('slug')}}</label>
                @error('slug')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror
                <input wire:model="slug" type="text" id="slug"
                class="mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                required disabled/>

                <label for="category"
                class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('category')}}</label>
                @error('category')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                <select class="w-full rounded-lg border border-blue-300 mb-4" wire:model="category_id">
                    <option></option>
                    {!! $categoryOptions !!}
                </select>

                <label for="brand"
                class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('brand')}}
                </label>
                @error('brand')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                {{-- <div class="w-full rounded-t-lg border-t border-l border-r border-gray-200 text-xs px-2 py-1">
                    Selected: {{$brand?->name}} ID: [{{$brand_id}}]
                    <div wire:loading wire:target="brand_id" class="bg-green-300 px-4">
                        Changing...
                    </div>
                </div>

                <livewire:search-dropdown wire:model.debounce.500ms.live="brand_id" :collection="$brands" /> --}}

                {{ $brand_id }}
                <input type="hidden" name="brand_id" id="brand_id" wire:model="brand_id" />
                <input type="text" name="search_brand_input" id="search_brand_input" placeholder="{{__('Search...')}}"/>
                <ul class="bg-white border w-full rounded mt-1 z-10 max-h-32 overflow-y-auto p-2 overflow-hidden">
                    @foreach ($brands as $brand)
                        <li
                            name="brands_list_item"
                            class="cursor-pointer hover:bg-gray-200 overflow-hidden" id="brand-{{$brand->id}}"
                            >
                            {{$brand->name}}
                        </li>
                    @endforeach
                </ul>


                @error('is_device')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                <div class="flex space-x-2 mt-4">
                    <input wire:model.live="is_device" type="checkbox" id="is_device"
                    class="mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required />
                    <label for="is_device"
                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('is_device')}}</label>
                </div>

            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalVisibility')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-danger-button class="ms-3" wire:click="store()">
                {{ __('Create') }}
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>

    <script src="{{asset('js/searchDropdown.js')"> </script>

    {{-- <script type="javaScript" src="{{asset('build/assets/js/searchDropdown.js')}}"></script> --}}

    {{-- <script>

        // Brands searchbar dropdown
        let brands_list = document.getElementsByName('brands_list_item');
        let brand_id = document.getElementById('brand_id');
        let search_brand_input = document.getElementById('search_brand_input');

        brands_list.forEach(item => {
            item.addEventListener('click', function() {
                handleClick(item);
            });
        });

        // Handle click on select list item.
        function handleClick(item) {

            // brand_id.dispatchEvent(new Event('input'));
            // console.log(@this.brand_id);
            // Livewire.dispatch('brandSelected', [item.id.slice(6)]);

            // Cut 'brand-' from string and push Id value.
            @this.brand_id = item.id.slice(6);
            brand_id.value = item.id.slice(6);

            // Get brand name and set in search input value.
            search_brand_input.value = item.textContent.trim();
        }

    </script> --}}

</div>
