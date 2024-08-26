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

                {{-- <livewire:search-dropdown wire:model.debounce.200ms.live="brand_id" :collection="$brands" /> --}}

                {{-- <label for="contact">Kontakt:</label> 
                <input type="text" name="contact" id="contact" list="contact-datalist relative">
                <datalist id="contact-datalist">
                    @foreach ($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </datalist> --}}

                <x-searchDropdown :collection="$brands" :inputName="'brand_id'" :searchBy="'name'" />

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

    @script




    <!-- Listening for Blade SearchDropdown combobox component data -->
    <!-- This is not Livewire SearchDropdown listener -->
        <script>
            
            $wire.on('closeModal', () => {
                console.log('close');
                document.querySelector('[x-data]').__x.$data.reset(); // Wywołaj metodę resetującą w Alpine.js
            });

            $wire.on('searchDropdownChange', (data) => {
                @this[data['uniqueId']] = data['value'];
                console.log('change');
            });
        </script>
    @endscript

</div>
