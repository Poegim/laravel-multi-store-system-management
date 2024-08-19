<div x-data="{ visibleList: false, search: '' }">
    <div class="flex">
        <x-input type="text" 
                 x-model="search" 
                 @input="visibleList = search.length > 0" 
                 wire:model.debounce.500ms.live="search" 
                 class="w-5/6 rounded-r-none" 
                 placeholder="{{__('Search...')}}" />

        <x-button @click="visibleList = !visibleList" class="w-1/6 rounded-l-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
        </x-button>

    </div>

        <ul x-show="visibleList" class="bg-white border mt-1 w-full rounded-lg z-10 max-h-32 overflow-y-auto p-2">
            @foreach ($searched as $searchItem)
            <li wire:click="selectItem({{$searchItem->id}}); visibleList = false"
                class="cursor-pointer hover:bg-gray-200">
                {{ $searchItem?->{$searchBy} }}
            </li>
            @endforeach
        </ul>

</div>