<div>
    <script>

        document.addEventListener('livewire:init', () => {

            Livewire.on('items-added', () => {

                console.log('Phone added, inputs cleared.');

               const search_product_input = document.getElementById('search_product_input');
               search_product_input.value = '';

               const search_device_input = document.getElementById('search_device_input');
               if(search_device_input)
               {
                   search_device_input.value = '';
               }

               const search_select_color = document.getElementById('search_select_color');
               search_select_color.value = '';

               let audioContext = new (window.AudioContext || window.webkitAudioContext)(); // Tworzymy kontekst raz
               let oscillator = audioContext.createOscillator();
               oscillator.type = 'sine';
               oscillator.frequency.setValueAtTime(500, audioContext.currentTime);
               oscillator.connect(audioContext.destination);
               oscillator.start();
               oscillator.stop(audioContext.currentTime + 0.2);

               console.log('Items added, inputs cleared.');

           });
        });
    </script>

        <x-window>
        @if ($errors->any())
        <x-lists.errors-list>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </x-lists.errors-list>
        @endif
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
                            <input type="text" id="search_product_input" name="search_product_input"
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
                        @foreach ($productVariants as $index => $variant)
                            <option value="{{ $variant->id }}" {{ $index == 0 ? 'selected' : '' }}>
                                {{ $variant->name }}
                            </option>
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
                            <input type="text" id="search_device_input" name="search_device_input"
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
                        @if($devices)
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
                        @endif
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
                            x-ref="inputField"
                            id="search_select_color"
                            name="search_select_color"
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
                                id="colorPreview"
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

        <div class="mt-6 pt-4 border-t border-gray-500 border-dotted grid sm:grid-cols-3 gap-2">
            <div class="gap-2">
                <div>
                    <x-label for="srp">{{ __('srp') }}</x-label>
                    <input wire:model="srp" type="number" step="0.01" min="0" max="99999.99" class="input-jetstream h-10 w-48"/>
                </div>
                <div x-data="{ locked: @entangle('lockQuantity') }">
                    <x-label for="quantity">{{ __('quantity') }}</x-label>
                    <input
                        x-bind:disabled="locked"
                        wire:model="quantity"
                        type="number"
                        step="1" min="0" max="99999" pattern="^[0-9]+$"
                        class="input-jetstream h-10 w-48"/>
                </div>
                <div class="flex gap-2">
                    <div>
                        <x-label for="purchase_price_net">{{ __('purchase_price_net') }}</x-label>
                        <input wire:model.debounce.500ms.live="purchase_price_net" type="number" step="0.01" min="0" max="99999.99" class="input-jetstream h-10 w-48"/>
                    </div>
                    <div>
                        <x-label for="vat_rate">{{ __('vat_rate') }}</x-label>
                        <select name="vat_rate" id="vat_rate" wire:model.debounce.500ms.live="vatRateId" class="input-jetstream h-10">
                            @foreach ($vatRates as $key => $vatRate)
                                <option value="{{$key}}">{{$vatRate}}%</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col justify-center">
                        <x-label for="purchase_price_gross">{{ __('purchase_price_gross') }}</x-label>
                        <div class="h-10 flex items-center">  <!-- Flex w pionie do wyśrodkowania -->
                            <span class="text-gray-500 italic">
                                {{ number_format($purchase_price_gross / 100, 2, '.', '') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sm:col-span-2 gap-2">
                @if ($product?->isDevice())
                    <div>
                        <x-label for="imei_number">{{ __('imei_number') }}</x-label>
                        <input wire:model="imei_number" class="input-jetstream h-10 w-full"/>
                    </div>
                    <div>
                        <x-label for="serial_number">{{ __('serial_number') }}</x-label>
                        <input wire:model="serial_number" class="input-jetstream h-10 w-full"/>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-6 pt-4 border-t border-gray-500 border-dotted space-y-2 flex space-x-2">
            <x-button type="button" wire:click="addItems">
                {{__('add_products')}}
            </x-button>
            <x-action-message class="me-3" on="items-added">
                Items added.
            </x-action-message>
        </div>
        </x-window>

        <div>

    <div class="max-w-full overflow-x-auto">
    <x-window>

        <div>
            <div class="flex w-full justify-between gap-2 text-sm">
                <div class="flex gap-2" x-data="{ aggregate: @entangle('aggregate') }">
                    <div class="my-auto">
                        {{ __('aggregate') }}
                    </div>
                    <button type="button" x-bind:class="aggregate ? 'bg-green-200' : 'bg-green-900'"
                        wire:click='aggragateItems()'
                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer my-auto rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-1 focus:ring-gray-200 focus:ring-offset-2 hover:bg-green-500"
                        role="switch" aria-checked="false">
                        <span class="sr-only">mode toggle</span>

                        <span x-bind:class="aggregate ? 'translate-x-5 bg-green-400' : 'translate-x-0 bg-black'"
                            class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full shadow ring-0 transition duration-200 ease-in-out">
                            <span
                                x-bind:class="aggregate ? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200'"
                                class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                                aria-hidden="true">
                                <svg fill="white" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M213.333 960c0-167.36 56-321.707 149.44-446.4L1406.4 1557.227c-124.693 93.44-279.04 149.44-446.4 149.44-411.627 0-746.667-335.04-746.667-746.667m1493.334 0c0 167.36-56 321.707-149.44 446.4L513.6 362.773c124.693-93.44 279.04-149.44 446.4-149.44 411.627 0 746.667 335.04 746.667 746.667M960 0C429.76 0 0 429.76 0 960s429.76 960 960 960 960-429.76 960-960S1490.24 0 960 0" fill-rule="evenodd"></path> </g></svg>
                            </span>
                            <span
                                x-bind:class="aggregate ?  'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100'"
                                class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                                aria-hidden="true">
                                <svg fill="#000000" version="1.1" id="Layer_1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <metadata> <sfw xmlns="&amp;ns_sfw;"> <slices> </slices> <slicesourcebounds width="505" height="984" bottomleftorigin="true" x="0" y="-984"> </slicesourcebounds> </sfw> </metadata> <g> <g> <g> <path d="M12,24C5.4,24,0,18.6,0,12S5.4,0,12,0s12,5.4,12,12S18.6,24,12,24z M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10 S17.5,2,12,2z"></path> </g> </g> <g> <g> <path d="M11,16c-0.3,0-0.5-0.1-0.7-0.3l-3-3c-0.4-0.4-0.4-1,0-1.4s1-0.4,1.4,0l3,3c0.4,0.4,0.4,1,0,1.4C11.5,15.9,11.3,16,11,16z "></path> </g> </g> <g> <g> <path d="M11,16c-0.3,0-0.5-0.1-0.7-0.3c-0.4-0.4-0.4-1,0-1.4l6-6c0.4-0.4,1-0.4,1.4,0s0.4,1,0,1.4l-6,6C11.5,15.9,11.3,16,11,16z "></path> </g> </g> </g> </g></svg>
                            </span>
                        </span>
                    </button>
                </div>
                <div class="flex gap-2">
                    <div class="my-auto">
                        {{ __('show_per_page') }}
                    </div>
                    <select name="paginatePerPage" id="paginatePerPage" wire:model.live="paginatePerPage" class="input-jetstream h-10">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>

            <table class="min-w-max w-full text-xs text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase">
                    <tr class="text-black dark:text-white">
                        <th scope="col" class="px-2 py-1">
                            @if($aggregate)
                                <span class="uppercase">
                                    {{__('qnt')}}
                                </span>
                            @else
                            <div class="flex cursor-pointer" wire:click="sortBy('id')">
                                <span class="uppercase">
                                    {{__('id')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-4 {{ $sortField === 'id' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                            @endif
                        </th>
                        <th scope="col" class="px-2 py-1">
                            @if($aggregate)
                            <span class="uppercase">
                                {{__('brand')}}
                            </span>
                            @else
                            <div class="flex cursor-pointer" wire:click="sortBy('brand_id')">
                                <span class="uppercase">
                                    {{__('brand')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-4 {{ $sortField === 'brand_id' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                            @endif
                        </th>
                        <th scope="col" class="px-2 py-1">
                            {{__('product')}}
                        </th>
                        <th scope="col" class="px-2 py-1">
                            @if($aggregate)
                            <span class="uppercase">
                                {{__('product_variant')}}
                            </span>
                            @else
                            <div class="flex cursor-pointer" wire:click="sortBy('product_variant_id')">
                                <span class="uppercase">
                                    {{__('product_variant')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-4 {{ $sortField === 'product_variant_id' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                            @endif
                        </th>
                        <th scope="col" class="px-2 py-1">
                            @if($aggregate)
                            <span class="uppercase">
                                {{__('device')}}
                            </span>
                            @else
                            <div class="flex cursor-pointer" wire:click="sortBy('device_id')">
                                <span class="uppercase">
                                    {{__('device')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-4 {{ $sortField === 'device_id' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                            @endif
                        </th>
                        <th scope="col" class="px-2 py-1 hidden 2xl:table-cell">
                            @if($aggregate)
                            <span class="uppercase">
                                {{__('color')}}
                            </span>
                            @else
                            <div class="flex cursor-pointer" wire:click="sortBy('color_id')">
                                <span class="uppercase">
                                    {{__('color')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-4 {{ $sortField === 'color_id' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                            @endif
                        </th>
                        <th scope="col" class="px-2 py-1 hidden lg:table-cell">
                            @if($aggregate)
                            <span class="uppercase">
                                {{__('srp')}}
                            </span>
                            @else
                            <div class="flex cursor-pointer" wire:click="sortBy('suggested_retail_price')">
                                <span class="uppercase">
                                    {{__('srp')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-4 {{ $sortField === 'suggested_retail_price' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                            @endif
                        </th>
                        <th scope="col" class="px-2 py-1 hidden lg:table-cell">
                            @if($aggregate)
                            <span class="uppercase">
                                {{__('ppn')}}
                            </span>
                            @else
                            <div class="flex cursor-pointer" wire:click="sortBy('purchase_price_net')">
                                <span class="uppercase">
                                    {{__('ppn')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-4 {{ $sortField === 'purchase_price_net' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                            @endif
                        </th>
                        <th scope="col" class="px-2 py-1 hidden lg:table-cell">
                            @if($aggregate)
                            <span class="uppercase">
                                {{__('ppg')}}
                            </span>
                            @else
                            <div class="flex cursor-pointer" wire:click="sortBy('purchase_price_gross')">
                                <span class="uppercase">
                                    {{__('ppg')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-4 {{ $sortField === 'purchase_price_gross' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                            @endif
                        </th>
                        <th scope="col" class="px-2 py-1 hidden lg:table-cell">
                            {{__('IMEI/SN')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($temporaryItems as $temporaryExternalInvoiceItem)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 w-full">
                        <td scope="row"
                            class="px-2 py-1 text-gray-900 whitespace-nowrap dark:text-white">
                            @if($aggregate)
                            {{ $temporaryExternalInvoiceItem->total_quantity }}
                            @else
                            {{$temporaryExternalInvoiceItem->id}}
                            @endif
                        </td>
                        <td scope="row"
                            class="px-2 py-1 text-gray-900 whitespace-nowrap dark:text-white">
                            {{$temporaryExternalInvoiceItem->brand->name}}
                        </td>
                        <td scope="row"
                            class="px-2 py-1  text-gray-900 whitespace-nowrap dark:text-white">
                            {{$temporaryExternalInvoiceItem->productVariant->product->name}}
                        </td>
                        <td scope="row"
                            class="px-2 py-1  text-gray-900 whitespace-nowrap dark:text-white">
                            {{$temporaryExternalInvoiceItem->productVariant->name}}
                        </td>
                        <td scope="row"
                            class="px-2 py-1  text-gray-900 whitespace-nowrap dark:text-white">
                            {{$temporaryExternalInvoiceItem->device->name}}
                        </td>
                        <td scope="row"
                            class="px-2 py-1  text-gray-900 whitespace-nowrap dark:text-white hidden 2xl:table-cell">
                            <div class="flex gap-x-2">
                                <div class="h-8 w-8 rounded-full" style="background-color: {{$temporaryExternalInvoiceItem->color->value}};">

                                </div>
                                <div class="my-auto">
                                    {{$temporaryExternalInvoiceItem->color->name}}
                                </div>
                            </div>
                        </td>
                        <td class="px-2 py-1 hidden lg:table-cell">
                            {{ number_format($temporaryExternalInvoiceItem->suggested_retail_price / 100, 2, '.', '') }}
                        </td>
                        <td scope="row"
                        class="px-2 py-1  text-gray-900 whitespace-nowrap dark:text-white hidden lg:table-cell">
                        {{ number_format($temporaryExternalInvoiceItem->purchase_price_net / 100, 2, '.', '') }}
                        </td>
                        <td scope="row"
                        class="px-2 py-1  text-gray-900 whitespace-nowrap dark:text-white hidden lg:table-cell">
                        {{ number_format($temporaryExternalInvoiceItem->purchase_price_gross / 100, 2, '.', '') }}
                        </td>
                        <td scope="row"
                        class="px-2 py-1  text-gray-900 whitespace-nowrap dark:text-white hidden lg:table-cell">
                            {{$temporaryExternalInvoiceItem->imei_number ? $temporaryExternalInvoiceItem->imei_number : $temporaryExternalInvoiceItem->serial_number }}
                        </td>
                        <td class="px-2 sm:px-2 sm:py-1 flex justify-end">
                            <x-buttons.delete-button wire:click="showRemoveItemModal({{ $temporaryExternalInvoiceItem }})">
                                {{__('delete')}}
                            </x-buttons.delete-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>


    </x-window>
    </div>
    @if($temporaryItems->hasPages())
    <x-window>
        {{ $temporaryItems->links(data: ['scrollTo' => false]) }}
    </x-window>
    @endif

    <x-window>
        <div class="flex justify-between">
            <div class="flex gap-2 my-auto text-sm">
                <div>
                    {{ __('net')}}: <span class="font-bold italic">{{ $net }}</span> {{__('currency')}},
                </div>
                <div>
                    {{ __('gross')}}: <span class="font-bold italic">{{ $gross }}</span> {{__('currency')}}
                </div>

            </div>
            <div>
                <x-secondary-button type="button" wire:click="$toggle('confirmCancelModal')">
                    {{__('cancel_invoice')}}
                </x-secondary-button>
                <x-danger-button type="button" wire:click="showConfirmInvoiceModal">
                    {{__('confirm_invoice')}}
                </x-danger-button>
            </div>
        </div>
    </x-window>

    <!-- Delete Invoice Modal -->
    <x-confirmation-modal wire:model.live="confirmCancelModal">
        <x-slot name="title">
            {{ __('delete_invoice') }}
        </x-slot>

        <x-slot name="content">
            {{ __('are_you_sure_you_want_to_delete_this_invoice?_this_action_cannot_be_undone!') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmCancelModal')" wire:loading.attr="disabled">
                {{ __('abort_this_action') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="confirmCancel" wire:loading.attr="disabled">
                {{ __('delete_invoice') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>

    <!-- Delete Item Modal -->
    <x-confirmation-modal wire:model.live="removeItemModal">
        <x-slot name="title">
            {{ __('delete_item') }}
        </x-slot>

        <x-slot name="content">
            {{ __('are_you_sure_you_want_to_delete_this_item?_this_action_cannot_be_undone!') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('removeItemModal')" wire:loading.attr="disabled">
                {{ __('cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="removeItem" wire:loading.attr="disabled">
                {{ __('delete') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>

    <!-- Confirm Invoice Modal -->
    <x-confirmation-modal wire:model.live="showConfirmInvoiceModal">
        <x-slot name="title">
            {{ __('delete_item') }}
        </x-slot>

        <x-slot name="content">
            <p>
                {{ __('do_you_want_to_confirm_this_invoice?_this_action_cannot_be_undone!') }}
            </p>
            <p>
                {{ __('after_confirming_the_invoice_you_will_not_be_able_to_edit_it_anymore_and_items_will_be_added_to_the_stock!') }}
            </p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showConfirmInvoiceModal')" wire:loading.attr="disabled">
                {{ __('cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="confirmInvoice" wire:loading.attr="disabled">
                {{ __('confirm_invoice') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>







</div>
