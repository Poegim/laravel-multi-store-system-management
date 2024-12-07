<div x-data="autocomplete('{{ $inputName }}', '{{ $searchBy }}', '{{ $optionalSearchBy }}', '{{ $passedId }}')" @click.away="closeDropdown()" class="relative">
    <div class="flex">
        <input
            x-model="query"
            @input.debounce.100ms="filterData"
            @keydown.arrow-down.prevent="moveDown"
            @keydown.arrow-up.prevent="moveUp"
            @keydown.enter.prevent="handleEnterKey"
            @focus="openDropdown()"
            type="text"
            :id="InputVisibleUniqueId"
            x-ref="InputVisibleUniqueId"
            placeholder="Search..."
            class="border-r-0 rounded-tl-lg rounded-bl-lg border-blue-400 px-3 py-2 w-full dark:bg-gray-900"

        />

        <button
            type="button"
            @click="toggleDropdown()"
            class="border border-l-0 rounded-tr-lg rounded-br-lg border-blue-400 pl-2">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-4 ml-auto mr-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>

        </button>
    </div>

    <input type="hidden"
        :id="uniqueId"
        :name="uniqueId"
        x-ref="hiddenInput"
        required
    />

    <ul x-show="open" class="border bg-white dark:bg-gray-800 w-full mt-1 z-90 max-h-48 overflow-y-auto absolute">
        <template x-for="(item, index) in filteredData" :key="index">
            <li
                :class="{'bg-blue-500 text-white': index === highlightedIndex}"
                @click="selectOption(index)"
                @mouseenter="highlightedIndex = index"
                class="px-4 py-1 cursor-pointer text-sm"
            >
            <span x-text="item[optionalSearchBy] && item[searchBy] !== item[optionalSearchBy]
            ? item[searchBy] + ' ' + item[optionalSearchBy]
            : item[searchBy]"></span>
        </li>
        </template>
    </ul>

    <script>
    function autocomplete(uniqueId, searchBy, optionalSearchBy, passedId = null) {
        return {
            query: '',
            open: false,
            highlightedIndex: 0,
            InputVisibleUniqueId: 'visible_' + uniqueId,
            uniqueId: uniqueId,
            passedId: passedId,
            searchBy: searchBy,
            optionalSearchBy: optionalSearchBy,
            originalData: @json($collection),
            selected: false,
            itemsCountLimit: passedId ? passedId + 1 : 100,
            filteredData: @json($collection).slice(this.itemsCountLimit-100,this.itemsCountLimit),

            init() {
                // If passedId is provided, select the corresponding option
                if (this.passedId != null) {
                    this.selectOptionById(this.passedId);
                }
            },

            filterData() {
                this.deselect();
                const search = this.query.toLowerCase();

                if (search === '') {
                    this.filteredData = this.originalData.slice(this.itemsCountLimit - 100, this.itemsCountLimit);
                    this.open = this.filteredData.length > 0;
                    return;
                }

                this.filteredData = this.originalData
                    .filter(item => {
                        const searchByValue = String(item[this.searchBy]).toLowerCase();
                        const optionalSearchByValue = String(item[this.optionalSearchBy] || '').toLowerCase(); // Dodano walidację na wypadek braku optionalSearchBy
                        return searchByValue.includes(search) || optionalSearchByValue.includes(search);
                    })
                    .slice(this.itemsCountLimit - 100, this.itemsCountLimit);

                this.open = this.filteredData.length > 0;
                this.highlightedIndex = 0;
            },

            moveDown() {
                if (this.highlightedIndex < this.filteredData.length - 1) {
                    this.highlightedIndex++;
                }
            },

            moveUp() {
                if (this.highlightedIndex > 0) {
                    this.highlightedIndex--;
                }
            },

            selectOption(index = this.highlightedIndex) {
                if (this.filteredData.length > 0 && index >= 0 && index < this.filteredData.length) {
                    const selectedItem = this.filteredData[index];
                    this.query = selectedItem[this.searchBy];
                    this.$refs.hiddenInput.value = selectedItem.id; // Set the hidden input value to the selected item's id.

                    //In case of passing data from parent fill input.
                    if(this.passedId != '' ) {
                        this.$refs.InputVisibleUniqueId.value = selectedItem[this.searchBy];
                    }

                    // Emit an event to the parent component with uniqueId and selected value
                    this.$dispatch('searchDropdownChange', {
                        uniqueId: this.uniqueId,
                        value: selectedItem.id
                    });

                    this.selected = true;
                    this.open = false;
                }
            },

            selectOptionById(id) {
                const index = this.originalData.findIndex(item => item.id == parseInt(id));
                if (index !== -1) {
                    this.selectOption(index);
                }
            },

            deselect() {
                if (this.selected === true) {

                    // Clear the hidden input and emit the deselect event
                    this.$refs.hiddenInput.value = '';
                    this.$dispatch('searchDropdownChange', {
                        uniqueId: this.uniqueId,
                        value: null
                    });

                    this.selected = false; // Reset selected state
                }
            },

            handleEnterKey() {
                this.selectOption();
            },

            openDropdown() {
                this.open = true;
            },

            closeDropdown() {
                this.open = false;
            },

            toggleDropdown() {
                this.open = !this.open;
            },
        };
    }
    </script>
</div>
