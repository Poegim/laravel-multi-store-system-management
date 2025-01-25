<div>
        <div class="grid sm:grid-cols-3 gap-2">

            <!-- SELECT BRAND -->
            <div x-data="{ locked: @entangle('lockBrand') }">
                <x-label for="brand_id">{{ __('select_brand') }}</x-label>
                <select
                    class="input-jetstream w-full"
                    name="brand_id"
                    id="brand_id"
                    x-bind:disabled="locked"
                    wire:model="brand">
                    <option value="">{{ __('Wybierz markę') }}</option> <!-- Dla opcji domyślnej -->
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- SELECT PRODUCT -->
            <div>
                <x-label >{{ __('select_product') }}</x-label>
                <div
                    x-data="{
                        visibleProductsList: false,
                        searchProduct: '',
                        selectedIndex: -1,
                        toggle() {
                            this.visibleProductsList = !this.visibleProductsList;
                        },
                        reset() {
                            this.visibleProductsList = false;
                            this.searchProduct = '';
                            this.selectedIndex = -1;
                        },
                        handleKeydown(event) {
                            if (!this.visibleProductsList) return;
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
                        let searchInput = document.getElementById('search_product_input');
                        searchInput.addEventListener('focus', () => {
                            if (!visibleProductsList) visibleProductsList = true;
                        });
                    "
                    class="relative"
                    @keydown.window="handleKeydown($event)"
                    @click.outside="visibleProductsList = false"
                >
                    <div class="overflow-hidden">
                        <div class="flex">

                            <!-- Input search -->
                            <input type="text" id="search_product_input"
                                x-model="searchProduct"
                                wire:model.debounce.500ms.live="searchProduct"
                                class="w-full rounded-md rounded-r-none border-r-0 border-gray-300 focus:border-gray-300 focus:ring-0 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200"
                                placeholder="{{ __('Search...') }}"
                            />


                            <!-- Dropdown button -->
                            <button @click="toggle" id="btn_product"
                                class="bg-white w-10 border-l-0 rounded-tr-lg rounded-br-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>

                            <div class="mx-2 flex text-blue-700 dark:text-green-300 w-[20px]">
                                <svg wire:loading wire:target="selectProduct" fill="currentColor" class="animate-spin my-auto size-6" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path class="fil0" d="M854.569 841.338c-188.268 189.444 -519.825 171.223 -704.157 -13.109 -190.56 -190.56 -200.048 -493.728 -28.483 -695.516 10.739 -12.623 21.132 -25.234 34.585 -33.667 36.553 -22.89 85.347 -18.445 117.138 13.347 30.228 30.228 35.737 75.83 16.531 111.665 -4.893 9.117 -9.221 14.693 -16.299 22.289 -140.375 150.709 -144.886 378.867 -7.747 516.005 152.583 152.584 406.604 120.623 541.406 -34.133 106.781 -122.634 142.717 -297.392 77.857 -451.04 -83.615 -198.07 -305.207 -291.19 -510.476 -222.476l-.226 -.226c235.803 -82.501 492.218 23.489 588.42 251.384 70.374 166.699 36.667 355.204 -71.697 493.53 -11.48 14.653 -23.724 28.744 -36.852 41.948z"></path></g></svg>
                            </div>
                        </div>

                    </div>

                    <!-- Dropdown list -->
                    <ul
                        x-show="visibleProductsList"
                        x-transition
                        class="absolute bg-white dark:bg-slate-900 dark:text-gray-400 border rounded mt-1 z-10 max-h-64 w-full overflow-y-auto shadow-lg focus:outline-none"
                    >
                        @foreach ($products as $index => $searchItem)
                        <li
                            wire:click="selectProduct({{ $searchItem->id }})"
                            :class="{'bg-gray-200': selectedIndex === {{ $index }}}"
                            class="cursor-pointer hover:bg-gray-200 dark:hover:bg-slate-700 p-2 focus:outline-none focus:bg-gray-500 focus:text-white"
                            tabindex="0"
                            @click="visibleProductsList = false"
                            @mouseenter="selectedIndex = {{ $index }}"
                            @mouseleave="selectedIndex = -1"
                        >
                            {{ $searchItem?->name }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- SELECT VARIANT -->
            <div>
                <x-label for="variant_id">{{ __('select_variant') }}</x-label>
                <select name="variant_id" id="variant_id" class="input-jetstream w-full" wire:model="productVariant">
                    @if ($product)
                    @foreach ($productVariants as $variant)
                        <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>

            @if (($product) && (!$product->is_device))
            <!-- SELECT DEVICE -->
            <div>
                <x-label >{{ __('select_device') }}</x-label>
                <div
                    x-data="{
                        visibleDevicesList: false,
                        searchDevice: '',
                        selectedIndex: -1,
                        toggle() {
                            this.visibleDevicesList = !this.visibleDevicesList;
                        },
                        reset() {
                            this.visibleDevicesList = false;
                            this.searchDevice = '';
                            this.selectedIndex = -1;
                        },
                        handleKeydown(event) {
                            if (!this.visibleDevicesList) return;
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
                        let searchInput = document.getElementById('search_device_input');
                        searchInput.addEventListener('focus', () => {
                            if (!visibleDevicesList) visibleDevicesList = true;
                        });
                    "
                    class="relative"
                    @keydown.window="handleKeydown($event)"
                    @click.outside="visibleDevicesList = false"
                >
                    <div class="overflow-hidden">
                        <div class="flex">
                            <!-- Search Input -->
                            <input type="text" id="search_device_input"
                                x-model="searchDevice"
                                wire:model.debounce.500ms.live="searchDevice"
                                class="w-full rounded-md rounded-r-none border-r-0 border-gray-300 focus:border-gray-300 focus:ring-0 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200"
                                placeholder="{{ __('Search...') }}"
                            />


                            <!-- Dropdown button -->
                            <button @click="toggle" id="btn_device"
                                class="bg-white w-10 border-l-0 rounded-tr-lg rounded-br-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>

                            <div class="mx-2 flex text-blue-700 dark:text-green-300 w-[20px]">
                                <svg wire:loading wire:target="selectDevice" fill="currentColor" class="animate-spin my-auto size-6" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path class="fil0" d="M854.569 841.338c-188.268 189.444 -519.825 171.223 -704.157 -13.109 -190.56 -190.56 -200.048 -493.728 -28.483 -695.516 10.739 -12.623 21.132 -25.234 34.585 -33.667 36.553 -22.89 85.347 -18.445 117.138 13.347 30.228 30.228 35.737 75.83 16.531 111.665 -4.893 9.117 -9.221 14.693 -16.299 22.289 -140.375 150.709 -144.886 378.867 -7.747 516.005 152.583 152.584 406.604 120.623 541.406 -34.133 106.781 -122.634 142.717 -297.392 77.857 -451.04 -83.615 -198.07 -305.207 -291.19 -510.476 -222.476l-.226 -.226c235.803 -82.501 492.218 23.489 588.42 251.384 70.374 166.699 36.667 355.204 -71.697 493.53 -11.48 14.653 -23.724 28.744 -36.852 41.948z"></path></g></svg>
                            </div>
                        </div>

                    </div>

                    <!-- Dropdown list -->
                    <ul
                        x-show="visibleDevicesList"
                        x-transition
                        class="absolute bg-white dark:bg-slate-900 dark:text-gray-400 border rounded mt-1 z-10 max-h-64 w-full overflow-y-auto shadow-lg focus:outline-none"
                    >
                        @foreach ($devices as $index => $searchItem)
                        <li
                            wire:click="selectDevice({{ $searchItem->id }})"
                            :class="{'bg-gray-200 dark:bg-slate-700': selectedIndex === {{ $index }}}"
                            class="cursor-pointer hover:bg-gray-200 dark:hover:bg-slate-700 p-2 focus:outline-none focus:bg-gray-500 focus:text-white"
                            tabindex="0"
                            @click="visibleDevicesList = false"
                            @mouseenter="selectedIndex = {{ $index }}"
                            @mouseleave="selectedIndex = null"
                        >
                            {{ $searchItem?->name }}
                        </li>
                        @endforeach
                    </ul>

                </div>
            </div>
            @endif

            <div x-data="{ expanded: false }" @click.outside="expanded = false">
                <!-- COLOR -->
                <div class="">
                    <div class="relative">
                        <x-label for="color">{{ __('select_color') }}</x-label>
                    </div>

                    <div class="flex relative" x-data="{ expanded: false }" >
                        <div class="flex w-full ">
                            <input
                            @click="expanded = true"
                            x-model="selectedColor"
                            x-ref="inputField"
                            class="w-full rounded-md rounded-r-none border-gray-300 focus:border-gray-300 border-r-0 focus:ring-0 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200"
                            placeholder="Search..." wire:model.live="searchColor"></input>
                            <button
                            @click="expanded = !expanded"
                            class="bg-white w-10 border-l-0 rounded-tr-lg rounded-br-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </button>
                            
                            <div 
                                class="my-auto ml-1 p-1"  
                                style="
                                    height: 4px;
                                    width: 4px;
                                    border-radius: 50%;
                                    display: inline-block;
                                    background-color: {{ $color ? $color['value'] : 'transparent' }};
                                "
                            >
                            </div>
                            
                            <div 
                                class="mx-1 flex text-blue-700 dark:text-green-300 w-[20px] rounded-full" 
                            >
                                <svg wire:loading wire:target="setColor" fill="currentColor" class="animate-spin my-auto size-6" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path class="fil0" d="M854.569 841.338c-188.268 189.444 -519.825 171.223 -704.157 -13.109 -190.56 -190.56 -200.048 -493.728 -28.483 -695.516 10.739 -12.623 21.132 -25.234 34.585 -33.667 36.553 -22.89 85.347 -18.445 117.138 13.347 30.228 30.228 35.737 75.83 16.531 111.665 -4.893 9.117 -9.221 14.693 -16.299 22.289 -140.375 150.709 -144.886 378.867 -7.747 516.005 152.583 152.584 406.604 120.623 541.406 -34.133 106.781 -122.634 142.717 -297.392 77.857 -451.04 -83.615 -198.07 -305.207 -291.19 -510.476 -222.476l-.226 -.226c235.803 -82.501 492.218 23.489 588.42 251.384 70.374 166.699 36.667 355.204 -71.697 493.53 -11.48 14.653 -23.724 28.744 -36.852 41.948z"></path></g></svg>
                            </div>
                        </div>

                        <div class="h-10">
                            <div
                                x-show="expanded"
                                @click.outside="expanded = false"
                                class="absolute top-10 left-0 mt-2 w-full border border-gray-500 bg-white dark:bg-gray-800 shadow-lg z-10 rounded-md">
                                <ul class="max-h-60 overflow-auto">
                                    @foreach ($colors as $color)
                                        <li
                                            class="flex items-center p-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-200"
                                            wire:click="setColor({{$color}})"
                                            @click="$refs.inputField.value = '{{ $color->name }}'; expanded = false;"
                                        >
                                            <span
                                                class="w-4 h-4 inline-block rounded-full mr-2"
                                                style="background-color: {{ $color->value ?? '#000' }};">
                                            </span>
                                            {{ $color->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



</div>
