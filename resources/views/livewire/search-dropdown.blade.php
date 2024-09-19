<div
    x-data="{ visibleList: true, search: '' }"
    x-init="
        document.addEventListener('resetSearchDropdownState', () => {
            visibleList = false; 
            @this.search = null;
        });

        let search_input = document.getElementById('search_input');
        let btn = document.getElementById('btn');

        search_input.addEventListener('focus', () => {
            if(visibleList === false) {visibleList = true};
        });

    "
>

    <div class="w-full flex space-x-2 mb-1">
        <div class="my-auto">
            Selected:&nbsp;
        </div>
            @if ($selectedItem)
            {{ $searched[$selectedItem]?->{$searchBy} }}, @if($searched[$selectedItem]?->id) id: {{ $searched[$selectedItem]?->id }} @endif
            <button type="button" wire:click="resetSelectedItem" class="mx-2 rounded-full text-white font-bold bg-red-800 hover:bg-red-500 hover:text-gray-200">
                <svg fill="currentColor" class="size-5 my-auto" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cancel</title> <path d="M10.771 8.518c-1.144 0.215-2.83 2.171-2.086 2.915l4.573 4.571-4.573 4.571c-0.915 0.915 1.829 3.656 2.744 2.742l4.573-4.571 4.573 4.571c0.915 0.915 3.658-1.829 2.744-2.742l-4.573-4.571 4.573-4.571c0.915-0.915-1.829-3.656-2.744-2.742l-4.573 4.571-4.573-4.571c-0.173-0.171-0.394-0.223-0.657-0.173v0zM16 1c-8.285 0-15 6.716-15 15s6.715 15 15 15 15-6.716 15-15-6.715-15-15-15zM16 4.75c6.213 0 11.25 5.037 11.25 11.25s-5.037 11.25-11.25 11.25-11.25-5.037-11.25-11.25c0.001-6.213 5.037-11.25 11.25-11.25z"></path> </g></svg>
            </button>
            @endif
    </div>

    <div class="overflow-hidden">
        <div class="flex">

            <x-input type="text" id="search_input"
            x-model="search"
            
            wire:model.debounce.500ms.live="search"
            class=" w-full rounded-tr-none rounded-br-none rounded-r-none rounded-t-none border-r-0"
            placeholder="{{__('Search...')}}"
            />

            <button @click="toggle" id="btn" class="bg-white p-0 m-0 w-10 rounded-l-none rounded-tr-lg rounded-br-lg  border border-right border-l-0 border-left-none border-top border-bottom">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>

        </div>
    </div>



    <ul id="list" x-show="visibleList" class="bg-white dark:bg-slate-900 dark:text-gray-400 border w-full rounded mt-1 z-10 max-h-32 overflow-y-auto p-2 overflow-hidden"
    x-data="{ selectedIndex: -1 }"
    @keydown.arrow-up.prevent="selectedIndex = (selectedIndex > 0) ? selectedIndex - 1 : $el.children.length - 1"
    @keydown.arrow-down.prevent="selectedIndex = (selectedIndex < $el.children.length - 1) ? selectedIndex + 1 : 0"
    @keydown.enter="if(selectedIndex >= 0) $el.children[selectedIndex].click()">
    
        @foreach ($searched as $index => $searchItem)
        <li wire:click="selectItem({{$searchItem->id}});"
            :class="{'bg-gray-200': selectedIndex === {{ $index }}}"
            class="w-full block cursor-pointer hover:bg-gray-200 dark:hover:bg-slate-700 overflow-hidden"
            tabindex="0"
            @mouseenter="selectedIndex = {{ $index }}"
            @mouseleave="selectedIndex = -1">
            {{ $searchItem?->{$searchBy} }}
        </li>
        @endforeach
    </ul>

    <script>
        function toggle() {
            this.visibleList = !this.visibleList;
        }
    </script>

</div>
