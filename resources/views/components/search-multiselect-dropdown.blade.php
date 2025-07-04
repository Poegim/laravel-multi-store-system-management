<div x-data="autocompleteMultiSelect('{{ $inputName }}', '{{ $searchBy }}', '{{ $passedIds }}')" @click.away="closeDropdown()" class="relative">

    <!-- Show choosen items-->
    <div class="flex flex-wrap gap-1 my-1">
        <template x-for="(selectedItem, index) in selectedItems" :key="index">
            <span class="bg-blue-500 text-white px-4 py-2 rounded-md flex items-center">
                <span x-text="selectedItem[searchBy]"></span>
                <button type="button" @click="removeItem(index)" class="text-xs">×</button>
            </span>
        </template>
    </div>

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

    <!-- Hidden input storing result array -->
    <input type="hidden" :id="uniqueId" :name="uniqueId" x-ref="hiddenInput" required />

    <!-- Search list -->
    <ul x-show="open" class="border bg-white dark:bg-gray-800 w-full z-90 max-h-64 overflow-y-auto absolute">
        <template x-for="(item, index) in filteredData" :key="index">
            <li
                :class="{
                    'bg-blue-600 text-white': index === highlightedIndex,
                    'bg-green-600': isSelected(item) //Check for selection
                }"
                @click="selectOption(index)"
                @mouseenter="highlightedIndex = index"
                class="px-4 py-1 cursor-pointer text-sm flex items-center"
            >
                <span x-text="item[searchBy]" class="flex-1"></span>
                <span x-show="isSelected(item)" class="ml-2 text-green-200">
                    &#10003;
                </span>
            </li>
        </template>
    </ul>

    <script>
    function autocompleteMultiSelect(uniqueId, searchBy, passedIds = null) {

        // Check if `passedIds` is a non-empty string
        if (typeof passedIds === 'string' && passedIds.trim() !== '') {
            try {
                passedIds = JSON.parse(passedIds);  // Attempt to parse `passedIds` into an array
            } catch (error) {
                console.error("Nie udało się przekonwertować passedIds na tablicę:", error);
                passedIds = []; // Set `passedIds` to an empty array if JSON.parse fails
            }
        } else {
            // If `passedIds` is an empty string or null, set it to an empty array
            passedIds = [];
        }

        return {
    query: '',
    open: false,
    highlightedIndex: 0,
    InputVisibleUniqueId: 'visible_' + uniqueId,
    uniqueId: uniqueId,
    passedIds: passedIds,
    searchBy: searchBy,
    originalData: [],
    filteredData: [],
    selectedItems: [],  // Wybrane elementy
    selected: false,
    dataLoaded: false,

    loadData(initializeSelectedItems = false) {
        const token = @json($token);

        fetch(`/api/get-data?search=${this.query}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response error.');
            }
            return response.json();
        })
        .then(data => {
            this.originalData = data.data;
            this.filteredData = data.data;

            // Jeśli `initializeSelectedItems` jest ustawione na true,
            // ustaw `selectedItems` na podstawie `passedIds` tylko raz
            if (initializeSelectedItems) {
                this.selectedItems = this.passedIds
                    .map(id => this.originalData.find(item => item.id === id))
                    .filter(Boolean); // Usunięcie `null`, jeśli ID nie istnieje
                this.$refs.hiddenInput.value = JSON.stringify(this.selectedItems.map(item => item.id));
            }
        })
        .catch(error => console.error('Loading data error:', error));
    },

    init() {
        // Załaduj dane po raz pierwszy i ustaw `selectedItems` tylko raz
        this.loadData(true);
    },

    filterData() {
        this.loadData(); // Bez inicjalizacji `selectedItems`
    },

    selectOption(index = this.highlightedIndex) {
        if (this.filteredData.length > 0 && index >= 0 && index < this.filteredData.length) {
            const selectedItem = this.filteredData[index];

            if (!this.selectedItems.find(item => item.id === selectedItem.id)) {
                this.selectedItems.push(selectedItem);
            }

            this.$refs.hiddenInput.value = JSON.stringify(this.selectedItems.map(item => item.id));
        }
    },

    removeItem(index) {
        this.selectedItems.splice(index, 1);
        this.$refs.hiddenInput.value = JSON.stringify(this.selectedItems.map(item => item.id));
    },

    isSelected(item) {
        return this.selectedItems.some(selected => selected.id === item.id);
    },

    handleEnterKey() {
        this.selectOption();
    },

    openDropdown() {
        this.open = true;
        this.loadData();
    },

    closeDropdown() {
        this.open = false;
    },

    toggleDropdown() {
        this.open = !this.open;
    }
};


    }

    </script>

</div>
