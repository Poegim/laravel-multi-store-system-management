@props(['inputName', 'collection'])

<div x-data="autocomplete('{{ $inputName }}')" class="relative">
    <input
        x-model="query"
        @input.debounce.300ms="filterData"
        @keydown.arrow-down.prevent="moveDown"
        @keydown.arrow-up.prevent="moveUp"
        @keydown.enter.prevent="handleEnterKey"
        type="text"
        :id="uniqueId"
        :name="uniqueId"
        placeholder="Search collection..."
        class="border px-3 py-2"
    />
    <ul x-show="open" class="absolute border bg-white w-full mt-1 z-10">
        <template x-for="(item, index) in filteredData" :key="index">
            <li 
                :class="{'bg-blue-500 text-white': index === highlightedIndex}"
                @click="selectOption(index)"
                @mouseenter="highlightedIndex = index"
                class="px-4 py-2 cursor-pointer"
            >
                <span x-text="item.name"></span>
            </li>
        </template>
    </ul>

    <script>
        function autocomplete(uniqueId) {
            return {
                query: '',
                open: false,
                highlightedIndex: 0,
                uniqueId: uniqueId,
                filteredData: @json($collection),
                filterData() {
                    const search = this.query.toLowerCase();
                    this.filteredData = @json($collection).filter(item => 
                        item.name.toLowerCase().includes(search)
                    );
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
                        this.query = this.filteredData[index].name;
                        this.open = false;
                    }
                },
                handleEnterKey() {
                    this.selectOption();
                }
            }
        }
    </script>
</div>
