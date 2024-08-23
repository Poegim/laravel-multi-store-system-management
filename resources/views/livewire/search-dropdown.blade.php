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
    <div class="overflow-hidden">
        <div class="flex">

            <x-input type="text" id="search_input"
            x-model="search"
            
            wire:model.debounce.500ms.live="search"
            class=" w-full rounded-r-none rounded-t-none border-r-0"
            placeholder="{{__('Search...')}}"
            />

            <button @click="toggle" id="btn" class="bg-white p-0 m-0 w-10 rounded-l-none rounded-tr-lg rounded-br-lg  border border-right border-l-0 border-left-none border-top border-bottom">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>

        </div>
    </div>

    <ul id="list" x-show="visibleList" class="bg-white border w-full rounded mt-1 z-10 max-h-32 overflow-y-auto p-2 overflow-hidden"
    x-data="{ selectedIndex: -1 }"
    @keydown.arrow-up.prevent="selectedIndex = (selectedIndex > 0) ? selectedIndex - 1 : $el.children.length - 1"
    @keydown.arrow-down.prevent="selectedIndex = (selectedIndex < $el.children.length - 1) ? selectedIndex + 1 : 0"
    @keydown.enter="if(selectedIndex >= 0) $el.children[selectedIndex].click()">
    
        @foreach ($searched as $index => $searchItem)
        <li wire:click="selectItem({{$searchItem->id}});"
            :class="{'bg-gray-200': selectedIndex === {{ $index }}}"
            class="w-full block cursor-pointer hover:bg-gray-200 overflow-hidden"
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
