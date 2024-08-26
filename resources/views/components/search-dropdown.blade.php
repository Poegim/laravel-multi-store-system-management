<div x-data="autocomplete('{{ $inputName }}', '{{ $searchBy }}')" @click.away="closeDropdown()" class="relative">
    <div class="flex">
        <input
            x-model="query"
            @input.debounce.300ms="filterData"
            @keydown.arrow-down.prevent="moveDown"
            @keydown.arrow-up.prevent="moveUp"
            @keydown.enter.prevent="handleEnterKey"
            @focus="openDropdown()"
            type="text"
            :id="InputVisibleUniqueId"
            :name="InputVisibleUniqueId"
            placeholder="Search..."
            class="border-r-0 rounded-tl-lg rounded-bl-lg border-blue-400 px-3 py-2 w-11/12"
        />
        
        <button 
            @click="toggleDropdown()" 
            class="border border-l-0 rounded-tr-lg rounded-br-lg border-blue-400 w-1/12">v</button>
    </div>
    
    <input type="hidden" 
        :id="uniqueId"
        :name="uniqueId"
        x-ref="hiddenInput"
    />

    <ul x-show="open" class="border bg-white w-full mt-1 z-90 max-h-96 overflow-y-auto">
        <template x-for="(item, index) in filteredData" :key="index">
            <li 
                :class="{'bg-blue-500 text-white': index === highlightedIndex}"
                @click="selectOption(index)"
                @mouseenter="highlightedIndex = index"
                class="px-4 py-2 cursor-pointer"
            >
                <span x-text="item[searchBy]"></span>
            </li>
        </template>
    </ul>

    <script>
        function autocomplete(uniqueId, searchBy) {
            return {
                query: '',
                open: false,
                highlightedIndex: 0,
                InputVisibleUniqueId: 'visible_' + uniqueId,
                uniqueId: uniqueId,
                searchBy: searchBy,
                originalData: @json($collection),
                filteredData: @json($collection),
                selected: false,
                filterData() {

                    // If user starts typing after a selection, deselect the current item
                    this.deselect();

                    const search = this.query.toLowerCase();
                    if (search === '') {
                        this.filteredData = this.originalData; // Show all items when search is empty
                        this.open = this.filteredData.length > 0;
                        return;
                    }
                    this.filteredData = this.originalData.filter(item => {
                        // Access the dynamic field and convert it to a string
                        const fieldValue = String(item[this.searchBy]);
                        return fieldValue.toLowerCase().includes(search);
                    });
                    this.open = this.filteredData.length > 0;
                    this.highlightedIndex = 0; // Reset highlighted index when filtering
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
                        this.$refs.hiddenInput.value = selectedItem.id; // Set the hidden input value to the selected item's id

                        // Emit an event to the parent component with uniqueId and selected value
                        this.$dispatch('searchDropdownChange', {
                            uniqueId: this.uniqueId,
                            value: selectedItem.id
                        });
                        this.selected = true;
                        this.open = false;
                    }
                },
                                
                deselect() {
                    if(this.selected === true) {
                        // Clear the hidden input and emit the deselect event
                        this.$refs.hiddenInput.value = '';
                        this.$dispatch('searchDropdownChange', {
                            uniqueId: this.uniqueId,
                            value: null
                        });
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

            }
        }
    </script>
</div>
