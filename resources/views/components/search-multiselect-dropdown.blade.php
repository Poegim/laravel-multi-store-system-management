<div x-data="autocompleteMultiSelect('{{ $inputName }}', '{{ $searchBy }}', '{{ $passedId }}')" @click.away="closeDropdown()" class="relative">
    
    <!-- Wprowadzenie elementów z listy wybranych -->
    <div class="flex flex-wrap gap-2 my-2">
        <template x-for="(selectedItem, index) in selectedItems" :key="index">
            <span class="bg-blue-500 text-white px-2 py-1 rounded-md flex items-center">
                <span x-text="selectedItem[searchBy]"></span>
                <button type="button" @click="removeItem(index)" class="text-xs">×</button>
            </span>
        </template>
    </div>

    <div class="flex">
        <input
            x-model="query"
            @input.debounce.200ms="filterData"
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

    <!-- Ukryte pole na wartości -->
    <input type="hidden" :id="uniqueId" :name="uniqueId" x-ref="hiddenInput" required />

    <!-- Lista wyników wyszukiwania -->
    <ul x-show="open" class="border bg-white dark:bg-gray-800 w-full mt-1 z-90 max-h-48 overflow-y-auto absolute">
        <template x-for="(item, index) in filteredData" :key="index">
            <li
                :class="{
                    'bg-blue-600 text-white': index === highlightedIndex,
                    'bg-green-600': isSelected(item)  // Sprawdzamy, czy element jest wybrany
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
    function autocompleteMultiSelect(uniqueId, searchBy, passedId = null) {
        return {
            query: '',
            open: false,
            highlightedIndex: 0,
            InputVisibleUniqueId: 'visible_' + uniqueId,
            uniqueId: uniqueId,
            passedId: passedId,
            searchBy: searchBy,
            originalData: [], // Początkowo pusta kolekcja
            filteredData: [],
            selectedItems: [],
            selected: false,
            dataLoaded: false, // Flaga, czy dane zostały załadowane

            // Ładowanie danych z API
            loadData() {
                fetch(`/api/get-data?search=${this.query}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        this.originalData = data.data;  // Jeśli używasz paginacji, dane będą w obiekcie 'data'
                        this.filteredData = data.data; // Zaktualizuj listę wyników
                        this.open = this.filteredData.length > 0; // Otwórz dropdown, jeśli są wyniki
                    })
                    .catch(error => console.error('Błąd w ładowaniu danych:', error));
            },

            filterData() {
                // Użyj debouncing, aby ograniczyć liczbę zapytań
                this.loadData();
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

                    // Sprawdzamy, czy element nie został już wybrany
                    if (!this.selectedItems.find(item => item.id === selectedItem.id)) {
                        this.selectedItems.push(selectedItem); // Dodanie elementu do wybranych
                    }

                    // Aktualizacja ukrytego inputu z wybranymi elementami w formie JSON
                    this.$refs.hiddenInput.value = JSON.stringify(this.selectedItems.map(item => item.id));

                    // Resetowanie query po wyborze
                    this.query = '';
                    this.open = false; // Zamknij dropdown po wyborze
                }
            },

            removeItem(index) {
                this.selectedItems.splice(index, 1); // Usuwanie elementu z wybranych

                // Aktualizacja ukrytego inputu po usunięciu elementu
                this.$refs.hiddenInput.value = JSON.stringify(this.selectedItems.map(item => item.id));
            },

            // Sprawdzanie, czy dany element jest już wybrany
            isSelected(item) {
                return this.selectedItems.some(selected => selected.id === item.id);
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
            }
        };
    }

        </script>
        
</div>
