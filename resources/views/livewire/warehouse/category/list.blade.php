<div class="ml-12 text-gray-800 dark:text-gray-200" x-data="{ open: true }">

    <div class="flex items-center rounded-lg py-1 ml-1">
        
        @if (array_key_exists('children', $category))
        <button @click="open = ! open" class=" -ml-9 mr-2 px-1 py-1 font-extrabold rounded bg-gray-200 dark:bg-gray-700 transition-all" :class="open ? '' : 'rotate-180'">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
        </button>           
        @endif

        <div class="w-full">
            <div class="px-2 rounded-lg flex w-full justify-between border-dotted border-b border-gray-500 py-1 hover:bg-gray-100 dark:hover:bg-gray-700">
                <span class="my-auto flex justify-between">
                    <x-buttons.edit-button class="ml-1 mr-2 my-auto flex" wire:click='edit({{ $category["id"] }})'/>
                    {{ $category['plural_name'] }} 
                    @if ($category['disabled'] == true)
                        <div class="ml-2 rounded  px-2 py-1 text-white italic text-xs bg-gradient-to-tr from-red-600 to-pink-900 m-auto">disabled</div>
                    @elseif($category['disabled'] == false)
                        <div class="ml-2 rounded px-2 py-1 text-white italic text-xs bg-gradient-to-tr from-green-600 to-sky-500 m-auto">enabled</div>
                    @endif
                </span>

                @if($parent)
                <span class="text-sm text-gray-400 dark:text-gray-500 italic my-auto"> {{__('parent_category')}}: {{ $parent? $parent['plural_name'] : ''}}</span>
                @endif
                    
            </div>
        </div>
    </div>

    @if (array_key_exists('children', $category))
    <div class="border-dotted border-l-[1px] border-gray-500 ml-4" x-show="open" x-collapse>
        @foreach ($category['children'] as $child)
        @include('livewire.warehouse.category.list', ['category' => $child, 'parent' => $category])
        @endforeach
    </div>
    @endif

</div>