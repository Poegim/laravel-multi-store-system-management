<div class="ml-12 text-gray-800 dark:text-gray-200" x-data="{ open: true }">

    <div class="flex items-center rounded-mid  py-1 ml-1">

        @if (array_key_exists('children', $category))
        <button @click="open = ! open" class="px-1 py-1 font-extrabold rounded bg-gray-200 dark:bg-gray-700 transition-all duration-150" :class="open ? '' : 'rotate-180'">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
        </button>
        @endif

        <div class="w-full ml-2">
            <div class="px-2 rounded-mid  w-full grid grid-cols-1 xl:grid-cols-2 border-dotted border-b border-gray-500 py-1 hover:bg-gray-100 dark:hover:bg-gray-700">
                <span class="my-auto flex">
                    <a class="link" href="{{route('category.show', $category['slug'])}}">{{ $category['plural_name'] }}</a>
                </span>

                <span class="flex justify-end space-x-2">
                    @if($parent)
                    <span class="hidden xl:flex text-sm text-gray-400 dark:text-gray-500 italic my-auto">
                        {{ __('parent category') }}: {{ $parent? $parent['plural_name'] : ''}}
                    </span>
                    @endif
                    @if ($category['disabled'] == true)
                    <div class="my-auto min-h-5 max-h-5 sm:min-h-7 sm:max-h-7 flex rounded-mid  px-2 roboto tracking-wider text-white italic text-xs bg-gradient-to-tr from-red-600 to-red-700 ">
                        <span class="my-auto mx-auto">
                            disabled
                        </span>
                    </div>
                    @elseif($category['disabled'] == false)
                    <div class="my-auto min-h-5 max-h-5  sm:min-h-7 sm:max-h-7  flex rounded-mid  px-2 roboto tracking-wider text-black italic text-xs bg-gradient-to-tr from-green-500 to-green-400 ">
                        <span class="my-auto mx-auto">
                            enabled
                        </span>
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
