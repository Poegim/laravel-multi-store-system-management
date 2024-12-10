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
                itemsCountLimit: passedId ? parseInt(passedId) + 1 : 100,
                filteredData: {}, // filteredData is now an object

                init() {
                    this.filteredData = this.originalData
                        .slice(this.itemsCountLimit - 100, this.itemsCountLimit)
                        .reduce((acc, item) => {
                            acc[item.id] = item; // Mapping data to an object with id as the key
                            return acc;
                        }, {});

                    // If passedId is provided, find the item in filteredData
                    if (this.passedId != null) {
                        const selectedItem = this.filteredData[this.passedId]; // Accessing the item by id

                        if (selectedItem) {
                            this.query = selectedItem[this.searchBy]; // Set the query input field
                            this.$refs.hiddenInput.value = selectedItem.id; // Set the hidden input field
                        } else {
                            console.warn("Item with passedId not found in filteredData");
                        }
                    }
                },

                filterData() {
                    this.deselect(); // Reset selection
                    const search = this.query.toLowerCase();

                    if (search === '') {
                        this.filteredData = this.originalData.slice(this.itemsCountLimit - 100, this.itemsCountLimit)
                            .reduce((acc, item) => {
                                acc[item.id] = item; // Mapping data to an object with id as the key
                                return acc;
                            }, {});
                        this.open = Object.keys(this.filteredData).length > 0; // Check if there are any filtered results
                        return;
                    }

                    this.filteredData = this.originalData
                        .filter(item => {
                            const searchByValue = String(item[this.searchBy]).toLowerCase();
                            const optionalSearchByValue = String(item[this.optionalSearchBy] || '').toLowerCase();
                            return searchByValue.includes(search) || optionalSearchByValue.includes(search);
                        })
                        .reduce((acc, item) => {
                            acc[item.id] = item; // Mapping data to an object with id as the key
                            return acc;
                        }, {});

                    this.open = Object.keys(this.filteredData).length > 0; // Check if there are any filtered results
                    this.highlightedIndex = 0; // Reset the highlighted index
                },

                moveDown() {
                    const keys = Object.keys(this.filteredData);
                    if (this.highlightedIndex < keys.length - 1) {
                        this.highlightedIndex++; // Move down the list
                    }
                },

                moveUp() {
                    if (this.highlightedIndex > 0) {
                        this.highlightedIndex--; // Move up the list
                    }
                },

                selectOption(id = Object.keys(this.filteredData)[this.highlightedIndex]) {
                    // Instead of using index, use id to select the option
                    const selectedItem = this.filteredData[id];
                    if (selectedItem) {
                        this.query = selectedItem[this.searchBy]; // Set the query input field
                        this.$refs.hiddenInput.value = selectedItem.id; // Set the hidden input field

                        // In case data is passed from the parent component, fill the input field
                        if (this.passedId != '') {
                            this.$refs.InputVisibleUniqueId.value = selectedItem[this.searchBy];
                        }

                        // Emit an event with the uniqueId and selected value
                        this.$dispatch('searchDropdownChange', {
                            uniqueId: this.uniqueId,
                            value: selectedItem.id
                        });

                        this.selected = true;
                        this.open = false; // Close the dropdown
                    }
                },

                deselect() {
                    if (this.selected === true) {
                        // Clear the hidden input and emit the deselection event
                        this.$refs.hiddenInput.value = '';
                        this.$dispatch('searchDropdownChange', {
                            uniqueId: this.uniqueId,
                            value: null
                        });

                        this.selected = false; // Reset the selection state
                    }
                },

                handleEnterKey() {
                    // Select the option when the Enter key is pressed
                    const keys = Object.keys(this.filteredData);
                    this.selectOption(keys[this.highlightedIndex]);
                },

                openDropdown() {
                    this.open = true; // Open the dropdown
                },

                closeDropdown() {
                    this.open = false; // Close the dropdown
                },

                toggleDropdown() {
                    this.open = !this.open; // Toggle the dropdown visibility
                },
            };
        }
    </script>
</div>
