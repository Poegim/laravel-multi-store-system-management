<div class="ml-12 text-gray-800 dark:text-gray-200" x-data="{ open: true }">

    <div class="flex items-center rounded-mid  py-0.5 ml-1">

        @if (array_key_exists('children', $category))
        <button @click="open = ! open" class="px-1 py-0.5 font-extrabold rounded bg-gray-200 dark:bg-gray-700 transition-all duration-150" :class="open ? '' : 'rotate-180'">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
        </button>
        @endif

        <div class="w-full ml-2">
            <div class="px-2 rounded-mid  w-full grid grid-cols-1 lg:grid-cols-2 border-dotted border py-0.5 border-gray-200 mt-1 hover:bg-gray-100 dark:hover:bg-gray-700">
                <span class="my-auto flex">
                    <a class="link" href="{{route('category.show', $category['slug'])}}">{{ $category['plural_name'] }}</a>
                </span>

                <span class="flex justify-end space-x-2">
                    @if($parent)
                    <span class="hidden lg:flex text-sm text-gray-400 dark:text-gray-500 italic my-auto">
                        {{ __('parent category') }}: {{ $parent? $parent['plural_name'] : ''}}
                    </span>
                    @endif
                    @if ($category['disabled'] == true)
                    <div class="text-white inline-flex items-center h-6 px-3 rounded-full text-xs font-semibold  bg-gradient-to-r from-red-500 to-red-600 shadow-sm">
                        disabled
                    </div>
                    @elseif($category['disabled'] == false)
                    <div class="inline-flex items-center h-6 px-3 rounded-full text-xs font-semibold text-green-900 bg-gradient-to-r from-green-400 to-green-500 shadow-sm">
                        enabled
                    </div>
                    @endif
                    <x-buttons.edit-button class="my-auto" wire:click='edit({{ $category["id"] }})'/>
                </span>

            </div>
        </div>
    </div>

    @if (array_key_exists('children', $category))
    <div class="border-dotted border-l-[1px] border-gray-500 ml-4" x-show="open" >
        @foreach ($category['children'] as $child)
        @include('livewire.warehouse.category.list', ['category' => $child, 'parent' => $category])
        @endforeach
    </div>
    @endif

</div>
