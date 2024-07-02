<div class="py-12 text-gray-800 dark:text-gray-200">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full flex justify-end my-4">
            <button wire:click="create()">
                <x-buttons.flowbite.cyan-to-blue>
                    <div class="flex">
                        <x-fas-plus class="w-6 h-6 mr-2" />
                        <span class="my-auto">
                            {{ __('CREATE') }}
                        </span>
                    </div>
                </x-buttons.flowbite.cyan-to-blue>
            </button>
        </div>
        {{-- 
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-4 rounded-lg shadow-lg">
                <ul class="list-none bg-gradient-to-tr from-white to-gray-100 dark:from-gray-900 dark:to-gray-800 pl-4 pb-4 pt-2 rounded-lg">
                    @foreach ($categories as $categoryName => $category)
                        @include('livewire.warehouse.category.list', ['name' => $categoryName, 'category' => $category])
                    @endforeach
                </ul>
            </div>
        </div>
        --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-4 rounded-lg shadow-lg">
                <div>
                    @foreach ($categories as $categoryName => $category)
                    @include('livewire.warehouse.category.list', ['name' => $categoryName, 'category' => $category,
                    'parent' => null])
                    @endforeach
                </div>
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

            <div class="mt-4 p-4 rounded-lg border border-gray-200 dark:border-gray-700">

                <label for="plural_name"
                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('plural_name')}}</label>
                @error('plural_name')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror
                <input wire:model="plural_name" type="plural_name" id="plural_name"
                    class="mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required value="{{$plural_name}}" />

                
            </div>


        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalVisibility')">
                {{ __('Cancel') }}
            </x-secondary-button>

            @if ($actionType === 'create')

            <x-danger-button class="ms-3" wire:click="storeModel()">
                {{ __('Create') }}
            </x-danger-button>

            @elseif ($actionType === 'edit')

            <x-danger-button class="ms-3" wire:click="update({{$category?->id}})">
                {{ __('Update') }}
            </x-danger-button>

            @endif
        </x-slot>
</x-dialog-modal>
</div>
