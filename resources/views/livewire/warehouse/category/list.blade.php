{{-- 
    <li class="my-2">
        <div class="flex items-center hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg py-1 px-2 m-2">
            <div>
                <x-buttons.edit-button />
            </div>
            <span class="text-lg mr-2">{{ $category['plural_name'] }}</span>
        </div>
        @if (array_key_exists('children', $category))
        <ul class="list-none ml-6 border-b border-l border-blue-200 dark:border-blue-400 pl-4 bg-gradient-to-tr from-white to-gray-100 dark:from-gray-900 dark:to-gray-800">
            @foreach ($category['children'] as $child)
            @include('livewire.warehouse.category.list', ['category' => $child])
            @endforeach
        </ul>
        @endif
    </li>
--}}

<div class="ml-4 text-gray-800 dark:text-gray-200" x-data="{ open: true }">

    <div class="flex items-center rounded-lg py-1 ml-1">
        
    @if (array_key_exists('children', $category))
        <button @click="open = ! open" class=" mr-2 rounded bg-gray-200 dark:bg-gray-700 transition-all" :class="open ? '' : 'rotate-180'">
            >
        </button>
        @else
            <
        @endif

        <div class="w-full">
        <button class="px-2 rounded-lg flex w-full justify-between border-dotted border-b border-gray-500 py-1 hover:bg-gray-100 dark:hover:bg-gray-700">
            <span class="my-auto flex">
                {{ $category['plural_name'] }}
            </span>
            @if($parent)
            <span class="text-sm text-gray-400 dark:text-gray-500 my-auto ml-4 italic"> {{__('parent_category')}}: {{ $parent? $parent['plural_name'] : ''}}</span>
            @endif
        </button>
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