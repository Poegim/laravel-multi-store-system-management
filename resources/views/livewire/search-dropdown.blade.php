<div
    x-data="{
        visibleList: false, 
        search: '',
        selectedIndex: -1,
        toggle() {
            this.visibleList = !this.visibleList;
        },
        reset() {
            this.visibleList = false;
            this.search = '';
            this.selectedIndex = -1;
        },
        handleKeydown(event) {
            if (!this.visibleList) return;
            const items = [...$el.querySelectorAll('ul > li')];
            if (event.key === 'ArrowDown') {
                this.selectedIndex = (this.selectedIndex + 1) % items.length;
                items[this.selectedIndex]?.scrollIntoView({ block: 'nearest' });
            } else if (event.key === 'ArrowUp') {
                this.selectedIndex = (this.selectedIndex - 1 + items.length) % items.length;
                items[this.selectedIndex]?.scrollIntoView({ block: 'nearest' });
            } else if (event.key === 'Enter' && this.selectedIndex >= 0) {
                items[this.selectedIndex]?.click();
            }
        }
    }"
    x-init="
        document.addEventListener('resetSearchDropdownState', () => reset());

        let searchInput = document.getElementById('search_input');
        searchInput.addEventListener('focus', () => {
            if (!visibleList) visibleList = true;
        });
    "
    class="relative"
    @keydown.window="handleKeydown($event)"
>
    <div class="overflow-hidden">
        <div class="flex">
            <!-- Input wyszukiwania -->
            <input type="text" id="search_input"
                x-model="search"
                wire:model.debounce.500ms.live="search"
                class="w-full rounded-md rounded-r-none border-r-0 border-gray-300 focus:border-gray-300 focus:ring-0"
                placeholder="{{ __('Search...') }}"
            />
        

            <!-- Przycisk rozwijania -->
            <button @click="toggle" id="btn" 
                class="bg-white w-10 border-l-0 rounded-tr-lg rounded-br-lg border border-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>

            <div class="mx-2 flex text-blue-700 dark:text-green-300">
                <svg wire:loading fill="currentColor" class="animate-spin my-auto size-6" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path class="fil0" d="M854.569 841.338c-188.268 189.444 -519.825 171.223 -704.157 -13.109 -190.56 -190.56 -200.048 -493.728 -28.483 -695.516 10.739 -12.623 21.132 -25.234 34.585 -33.667 36.553 -22.89 85.347 -18.445 117.138 13.347 30.228 30.228 35.737 75.83 16.531 111.665 -4.893 9.117 -9.221 14.693 -16.299 22.289 -140.375 150.709 -144.886 378.867 -7.747 516.005 152.583 152.584 406.604 120.623 541.406 -34.133 106.781 -122.634 142.717 -297.392 77.857 -451.04 -83.615 -198.07 -305.207 -291.19 -510.476 -222.476l-.226 -.226c235.803 -82.501 492.218 23.489 588.42 251.384 70.374 166.699 36.667 355.204 -71.697 493.53 -11.48 14.653 -23.724 28.744 -36.852 41.948z"></path></g></svg>
            </div>
        </div>
    </div>

    <!-- Lista rozwijana -->
    <ul 
        x-show="visibleList" 
        x-transition
        class="absolute bg-white dark:bg-slate-900 dark:text-gray-400 border rounded mt-1 z-10 max-h-64 w-full overflow-y-auto shadow-lg focus:outline-none"
    >
        @foreach ($searched as $index => $searchItem)
        <li 
            wire:click="selectItem({{ $searchItem->id }})"
            :class="{'bg-gray-200': selectedIndex === {{ $index }}}"
            class="cursor-pointer hover:bg-gray-200 dark:hover:bg-slate-700 p-2 focus:outline-none focus:text-white"
            tabindex="0"
            @click="visibleList = false"
            @mouseenter="selectedIndex = {{ $index }}"
            @mouseleave="selectedIndex = -1"
        >
            {{ $searchItem?->{$searchBy} }}
        </li>
        @endforeach
    </ul>
</div>