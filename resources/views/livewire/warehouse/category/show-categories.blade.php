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
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-4 rounded-lg shadow-lg">
                <ul class="list-none bg-gradient-to-tr from-white to-gray-100 dark:from-gray-900 dark:to-gray-800 pl-4 pb-4 pt-2 rounded-lg">
                    @foreach ($categories as $categoryName => $category)
                        @include('livewire.warehouse.category.list', ['name' => $categoryName, 'category' => $category])
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
