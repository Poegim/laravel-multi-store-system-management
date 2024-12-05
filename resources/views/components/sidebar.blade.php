<div class="h-full" x-data="{
                lastClicked: localStorage.getItem('lastClickedButton') || 'none',
                setLastClicked(button) {
                    if (this.lastClicked === button) {
                        this.lastClicked = 'none'; // Toggle visibility on double click
                    } else {
                        this.lastClicked = button;
                    }
                    localStorage.setItem('lastClickedButton', this.lastClicked);
                }
            }">

    <!-- Sidebar -->
    <aside id="default-sidebar" class="lg:block w-full h-full lg:w-80" aria-label="Sidenav">
        <div
            class="sm:text-sm overflow-y-auto py-5 sm:px-3 h-full bg-white md:border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">

            <img src="{{ asset('logo.png') }}" width="200" alt="logo" class="mx-auto mb-4 hidden md:block">
            {{-- <div class="w-full text-center font-bold italic dark:text-gray-200 mb-4">LMSSM</div> --}}

            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}"
                       @click="setLastClicked('dashboard')"
                       wire:navigate
                       class="flex items-center py-1 px-2 rounded-mid group {{ request()->routeIs('dashboard') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 0 1 8.25-8.25.75.75 0 0 1 .75.75v6.75H18a.75.75 0 0 1 .75.75 8.25 8.25 0 0 1-16.5 0Z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M12.75 3a.75.75 0 0 1 .75-.75 8.25 8.25 0 0 1 8.25 8.25.75.75 0 0 1-.75.75h-7.5a.75.75 0 0 1-.75-.75V3Z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-3 roboto tracking-wide sm:text-lg">Dashboard</span>
                    </a>
                </li>

                <li>
                    <button type="button" @click="setLastClicked('stores')"
                        class="flex items-center py-1 px-2 w-full transition duration-75 group rounded-mid nav-inactive-tab">
                        <svg class="size-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5.535 7.677c.313-.98.687-2.023.926-2.677H17.46c.253.63.646 1.64.977 2.61.166.487.312.953.416 1.347.11.42.148.675.148.779 0 .18-.032.355-.09.515-.06.161-.144.3-.243.412-.1.111-.21.192-.324.245a.809.809 0 0 1-.686 0 1.004 1.004 0 0 1-.324-.245c-.1-.112-.183-.25-.242-.412a1.473 1.473 0 0 1-.091-.515 1 1 0 1 0-2 0 1.4 1.4 0 0 1-.333.927.896.896 0 0 1-.667.323.896.896 0 0 1-.667-.323A1.401 1.401 0 0 1 13 9.736a1 1 0 1 0-2 0 1.4 1.4 0 0 1-.333.927.896.896 0 0 1-.667.323.896.896 0 0 1-.667-.323A1.4 1.4 0 0 1 9 9.74v-.008a1 1 0 0 0-2 .003v.008a1.504 1.504 0 0 1-.18.712 1.22 1.22 0 0 1-.146.209l-.007.007a1.01 1.01 0 0 1-.325.248.82.82 0 0 1-.316.08.973.973 0 0 1-.563-.256 1.224 1.224 0 0 1-.102-.103A1.518 1.518 0 0 1 5 9.724v-.006a2.543 2.543 0 0 1 .029-.207c.024-.132.06-.296.11-.49.098-.385.237-.85.395-1.344ZM4 12.112a3.521 3.521 0 0 1-1-2.376c0-.349.098-.8.202-1.208.112-.441.264-.95.428-1.46.327-1.024.715-2.104.958-2.767A1.985 1.985 0 0 1 6.456 3h11.01c.803 0 1.539.481 1.844 1.243.258.641.67 1.697 1.019 2.72a22.3 22.3 0 0 1 .457 1.487c.114.433.214.903.214 1.286 0 .412-.072.821-.214 1.207A3.288 3.288 0 0 1 20 12.16V19a2 2 0 0 1-2 2h-6a1 1 0 0 1-1-1v-4H8v4a1 1 0 0 1-1 1H6a2 2 0 0 1-2-2v-6.888ZM13 15a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2Z" clip-rule="evenodd"/>
                          </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap roboto tracking-wide sm:text-lg">Stores</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <ul class="mt-2 overflow-hidden space-y-2 border border-gray-300 dark:border-gray-700 rounded-mid "
                        x-collapse.duration.50 x-show="lastClicked === 'stores'">

                        @foreach ($stores as $store)
                            <li>
                                <a href="{{ route('store.show', $store->id) }}" wire:navigate
                                    class="flex py-1 px-2 transition duration-75 group {{ url()->current() == route('store.show', $store->id) ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                                    <span class="ml-11 roboto tracking-wide sm:text-lg">
                                        {{ $store->name}}
                                    </span>
                                </a>
                            </li>
                        @endforeach


                    </ul>
                </li>

                <li>
                    <button type="button" @click="setLastClicked('repository')"
                        class="flex items-center py-1 px-2 w-full transition duration-75 group rounded-mid nav-inactive-tab">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path
                                d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875Z" />
                            <path
                                d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 0 0 1.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 0 0 1.897 1.384C6.809 12.164 9.315 12.75 12 12.75Z" />
                            <path
                                d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 15.914 9.315 16.5 12 16.5Z" />
                            <path
                                d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 19.664 9.315 20.25 12 20.25Z" />
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap roboto tracking-wide sm:text-lg">Repository</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <ul class="mt-2 overflow-hidden space-y-2 border border-gray-300 dark:border-gray-700 rounded-mid "
                        x-collapse.duration.50 x-show="lastClicked === 'repository'">

                        <li>
                            <a href="{{ route('category.index') }}" wire:navigate
                                class="flex items-center py-1 px-2 pl-11 w-full transition duration-75 group {{ request()->routeIs('category.index') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M7.491 5.992a.75.75 0 0 1 .75-.75h12a.75.75 0 1 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM7.49 11.995a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM7.491 17.994a.75.75 0 0 1 .75-.75h12a.75.75 0 1 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM2.24 3.745a.75.75 0 0 1 .75-.75h1.125a.75.75 0 0 1 .75.75v3h.375a.75.75 0 0 1 0 1.5H2.99a.75.75 0 0 1 0-1.5h.375v-2.25H2.99a.75.75 0 0 1-.75-.75ZM2.79 10.602a.75.75 0 0 1 0-1.06 1.875 1.875 0 1 1 2.652 2.651l-.55.55h.35a.75.75 0 0 1 0 1.5h-2.16a.75.75 0 0 1-.53-1.281l1.83-1.83a.375.375 0 0 0-.53-.53.75.75 0 0 1-1.062 0ZM2.24 15.745a.75.75 0 0 1 .75-.75h1.125a1.875 1.875 0 0 1 1.501 2.999 1.875 1.875 0 0 1-1.501 3H2.99a.75.75 0 0 1 0-1.501h1.125a.375.375 0 0 0 .036-.748H3.74a.75.75 0 0 1-.75-.75v-.002a.75.75 0 0 1 .75-.75h.411a.375.375 0 0 0-.036-.748H2.99a.75.75 0 0 1-.75-.75Z"
                                        clip-rule="evenodd" />
                                </svg> --}}
                                <svg viewBox="0 0 48 48" class="size-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier"> <title>tree-structure</title>
                                        <g id="Layer_2" data-name="Layer 2"> <g id="invisible_box" data-name="invisible box">
                                            <rect fill="none"></rect> </g> <g id="Q3_icons" data-name="Q3 icons">
                                                <path d="M26,30H42a2,2,0,0,0,2-2V20a2,2,0,0,0-2-2H26a2,2,0,0,0-2,2v2H16V14h6a2,2,0,0,0,2-2V4a2,2,0,0,0-2-2H6A2,2,0,0,0,4,4v8a2,2,0,0,0,2,2h6V40a2,2,0,0,0,2,2H24v2a2,2,0,0,0,2,2H42a2,2,0,0,0,2-2V36a2,2,0,0,0-2-2H26a2,2,0,0,0-2,2v2H16V26h8v2A2,2,0,0,0,26,30Zm2-8H40v4H28ZM8,6H20v4H8ZM28,38H40v4H28Z">
                                                    </path> </g> </g> </g></svg>
                                <span class="ml-2 roboto tracking-wide sm:text-lg">Categories</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('brand.index') }}" wire:navigate
                                class="flex items-center py-1 px-2 pl-11 w-full transition duration-75 group {{ request()->routeIs('brand.index') ? 'nav-active-tab' : 'nav-inactive-tab' }}">
                                <svg
                                class="size-6"
                                fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512">
                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M368 80c-3.2 0-6.2 .4-8.9 1.3C340 86.8 313 91.9 284.8 84.6C227.4 69.7 160.2 92 110.1 142.1S37.7 259.4 52.6 316.8c7.3 28.2 2.2 55.2-3.3 74.3c-.8 2.8-1.3 5.8-1.3 8.9c0 17.7 14.3 32 32 32c3.2 0 6.2-.4 8.9-1.3c19.1-5.5 46.1-10.7 74.3-3.3c57.4 14.9 124.6-7.4 174.7-57.5s72.4-117.3 57.5-174.7c-7.3-28.2-2.2-55.2 3.3-74.3c.8-2.8 1.3-5.8 1.3-8.9c0-17.7-14.3-32-32-32zm0-48c44.2 0 80 35.8 80 80c0 7.7-1.1 15.2-3.1 22.3c-4.6 15.8-7.1 32.9-3 48.9c20.1 77.6-10.9 161.5-70 220.7s-143.1 90.2-220.7 70c-16-4.1-33-1.6-48.9 3c-7.1 2-14.6 3.1-22.3 3.1c-44.2 0-80-35.8-80-80c0-7.7 1.1-15.2 3.1-22.3c4.6-15.8 7.1-32.9 3-48.9C-14 251.3 17 167.3 76.2 108.2S219.3 18 296.8 38.1c16 4.1 33 1.6 48.9-3c7.1-2 14.6-3.1 22.3-3.1zM246.7 167c-52 15.2-96.5 59.7-111.7 111.7c-3.7 12.7-17.1 20-29.8 16.3s-20-17.1-16.3-29.8c19.8-67.7 76.6-124.5 144.3-144.3c12.7-3.7 26.1 3.6 29.8 16.3s-3.6 26.1-16.3 29.8z"/>
                            </svg>
                                <span class="ml-2 roboto tracking-wide sm:text-lg">Brands</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('product.index') }}" wire:navigate
                                class="flex items-center py-1 px-2 pl-11 w-full  transition duration-75 group {{ request()->routeIs('product.index') ? 'nav-active-tab' : 'nav-inactive-tab' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                                </svg>
                                <span class="ml-2 roboto tracking-wide sm:text-lg">Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('product-variant.index') }}" wire:navigate
                                class="flex items-center py-1 px-2 pl-11 w-full  transition duration-75 group {{ request()->routeIs('product-variant.index') ? 'nav-active-tab' : 'nav-inactive-tab' }}">
                                <svg class="size-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 8v8m0-8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 8a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8-8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 0a4 4 0 0 1-4 4h-1a3 3 0 0 0-3 3"/>
                                  </svg>

                                <span class="ml-2 roboto tracking-wide sm:text-lg">Variants</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('feature.index')}}" wire:navigate
                                class="flex items-center py-1 px-2 pl-11 w-full  transition duration-75 group {{request()->routeIs('feature.index') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z" />
                                </svg>
                                <span class="ml-2 roboto tracking-wide sm:text-lg">Features</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#"
                       @click="setLastClicked('none')"
                       wire:navigate
                       class="flex items-center py-1 px-2 rounded-mid group {{ request()->routeIs('warehouse.test.index') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                       <svg fill="currentColor" class="size-6" version="1.2" baseProfile="tiny" id="inventory" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 256 230" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M61.2,106h37.4v31.2H61.2V106z M61.2,178.7h37.4v-31.2H61.2V178.7z M61.2,220.1h37.4v-31.2H61.2V220.1z M109.7,178.7H147 v-31.2h-37.4V178.7z M109.7,220.1H147v-31.2h-37.4V220.1z M158.2,188.9v31.2h37.4v-31.2H158.2z M255,67.2L128.3,7.6L1.7,67.4 l7.9,16.5l16.1-7.7v144h18.2V75.6h169v144.8h18.2v-144l16.1,7.5L255,67.2z"></path> </g></svg>
                       <span class="ml-3 roboto tracking-wide sm:text-lg">Warehouse</span>
                    </a>
                    </a>
                </li>

                <li>
                    <a href="{{ route('contact.index') }}"
                       @click="setLastClicked('contacts')"
                       wire:navigate
                       class="flex items-center py-1 px-2 rounded-mid group {{ request()->routeIs('contact.index') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                        <svg fill="currentColor" class="size-6" viewBox="0 0 512 512" enable-background="new 0 0 512 512" id="Teamwork" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <circle cx="377.172" cy="164.224" r="37.081"></circle> <path d="M174.829,491.418l14.338-107.463l-4.645-34.808l1.414-1.28l-26.719-24.368l-0.225-0.224 c-17.494-17.521-19.881-44.519-7.158-64.61l-0.721-1.063l7.842-7.953l20.902-20.902c1.477-1.479,2.988-2.528,4.514-3.786 c-11.586-6.324-24.668-9.461-38.1-9.461h-21.398c-21.104,0-41.354,7.223-56.271,22.139L47.7,257.5h0.043 c-15.029,16-15.029,40.289,0,55.344l38.881,35.893L67.409,492.919c-0.383,2.881,1.867,5.581,4.77,5.581h29.363 c2.408,0,4.432-1.674,4.77-4.059l15.908-115.395c0.268-1.957,0.924-3.755,1.869-5.374c5.016-8.553,17.953-8.538,22.947,0.013 c0.969,1.619,1.621,3.448,1.889,5.407l15.91,115.347c0.338,2.387,2.361,4.061,4.77,4.061h5.711 C174.69,496.5,174.511,493.824,174.829,491.418z M93.173,304.668l-12.285-12.307c-3.285-3.285-3.285-8.596,0-11.881l15.545-15.545 c0.811-0.813,2.184-0.137,2.027,1.01L93.173,304.668z"></path> <circle cx="135.571" cy="164.225" r="37.081"></circle> <path d="M211.427,64.974l5.396,1.191c0.971,0.213,1.704,0.971,1.919,1.939c0.834,3.764,2.206,7.322,4.049,10.584 c0.465,0.82,0.434,1.828-0.074,2.625l-3.352,5.225c-0.646,1.008-0.505,2.328,0.343,3.174l5.258,5.264 c0.85,0.846,2.167,0.988,3.175,0.344l4.749-3.041c0.838-0.537,1.913-0.531,2.75,0.008c3.148,2.014,6.607,3.588,10.289,4.627 c0.902,0.256,1.592,0.984,1.793,1.9l1.334,6.39c0.258,1.164,1.291,2.296,2.488,2.296h7.441c1.197,0,2.232-1.132,2.486-2.296 l1.201-5.613c0.213-0.975,0.977-1.806,1.955-2.017c3.775-0.813,7.346-2.212,10.621-4.039c0.82-0.457,1.822-0.447,2.611,0.059 l5.178,3.306c1.01,0.646,2.33,0.5,3.176-0.348l5.262-5.263c0.846-0.846,0.988-2.167,0.346-3.178l-2.949-4.602 c-0.539-0.844-0.529-1.921,0.016-2.761c2.076-3.195,3.691-6.719,4.754-10.477c0.256-0.9,0.984-1.588,1.902-1.787l5.907-1.287 c1.168-0.254,2.047-1.291,2.047-2.486v-7.441c0-1.195-0.879-2.23-2.047-2.488l-5.222-1.141c-0.98-0.215-1.749-0.982-1.956-1.961 c-0.822-3.879-2.228-7.541-4.118-10.895c-0.461-0.82-0.438-1.826,0.068-2.619l3.17-4.951c0.645-1.006,0.501-2.328-0.347-3.172 l-5.262-5.264c-0.846-0.846-2.164-0.99-3.172-0.344l-4.427,2.834c-0.842,0.539-1.918,0.531-2.758-0.014 c-3.254-2.105-6.844-3.734-10.674-4.791c-0.908-0.252-1.602-0.982-1.807-1.904l-1.25-5.883c-0.258-1.168-1.293-2.177-2.488-2.177 h-7.441c-1.197,0-2.232,1.009-2.486,2.177l-1.135,5.26c-0.213,0.973-0.975,1.769-1.949,1.981c-3.865,0.842-7.518,2.284-10.854,4.19 c-0.822,0.467-1.836,0.455-2.631-0.055l-4.998-3.198c-1.01-0.643-2.33-0.499-3.176,0.349l-5.262,5.262 c-0.848,0.846-0.99,2.167-0.344,3.174l2.928,4.573c0.535,0.838,0.531,1.907-0.002,2.745c-2.049,3.205-3.635,6.732-4.668,10.488 c-0.25,0.908-0.984,1.605-1.904,1.809l-5.863,1.303c-1.17,0.254-1.927,1.289-1.927,2.486v7.441 C209.5,63.681,210.257,64.716,211.427,64.974z M256.378,37.8c12.193,0,22.076,9.885,22.076,22.076 c0,12.193-9.883,22.076-22.076,22.076c-12.191,0-22.074-9.883-22.074-22.076C234.304,47.685,244.187,37.8,256.378,37.8z"></path> <path d="M135.167,106.572c0.287,0.041,0.57,0.059,0.852,0.059c3.041,0,5.695-2.246,6.121-5.344 c2.762-20.082,20.154-35.223,40.459-35.223c3.416,0,6.188-2.771,6.188-6.188s-2.771-6.188-6.188-6.188 c-26.455,0-49.119,19.738-52.719,45.91C129.413,102.984,131.782,106.107,135.167,106.572z"></path> <path d="M327.524,66.064c20.35,0,37.748,15.182,40.469,35.311c0.42,3.107,3.076,5.359,6.123,5.359c0.277,0,0.557-0.018,0.838-0.057 c3.387-0.459,5.762-3.574,5.305-6.961c-3.549-26.238-26.219-46.027-52.734-46.027c-3.418,0-6.188,2.771-6.188,6.188 S324.106,66.064,327.524,66.064z"></path> <path d="M316.776,435.057l-11.451-85.861l11.475-10.461l27.404-24.998c15.031-15.051,15.031-39.443,0-54.473l0.045-0.068 l-20.902-20.903c-2.092-2.092-4.297-3.815-6.592-5.59c-14.041-11.271-31.545-17.202-49.68-17.202h-21.4 c-18.133,0-35.639,5.931-49.68,17.181c-2.293,1.797-4.5,3.649-6.592,5.741l-20.902,20.837l0.047,0.037 c-15.029,15.029-15.029,39.404,0,54.457l27.404,24.987l11.473,10.458l-11.451,85.86l-7.76,58.206 c-0.361,2.721,1.619,5.06,4.273,5.331c0.158,0.021,0.338-0.096,0.494-0.096h29.363c2.406,0,4.432-1.664,4.768-4.047l15.91-115.389 c0.27-1.957,0.922-3.774,1.867-5.394c5.018-8.527,17.955-8.515,22.949,0.013c0.967,1.619,1.621,3.472,1.891,5.433l15.908,115.333 c0.336,2.385,2.361,4.051,4.77,4.051h29.363c0.154,0,0.336,0.115,0.494,0.094c2.654-0.273,4.637-2.666,4.275-5.389L316.776,435.057 z M213.974,304.691l-12.285-12.309c-3.285-3.285-3.285-8.594,0-11.879l15.549-15.547c0.811-0.811,2.182-0.137,2.025,0.988 L213.974,304.691z M293.487,265.945c-0.154-1.125,1.217-1.799,2.027-0.988l15.547,15.547c3.285,3.285,3.285,8.594,0,11.879 l-12.285,12.309L293.487,265.945z"></path> <path d="M465.007,259.242l0.043-0.068l-20.898-20.634c-14.941-14.916-35.17-23.04-56.275-23.04h-21.396 c-13.445,0-26.539,3.142-38.131,9.485c1.525,1.291,3.045,2.522,4.543,4.02l28.791,28.66l-0.766,1.063 c12.723,20.096,10.336,47.057-7.162,64.58l-0.453,0.417L326.81,347.88l1.42,1.296l-4.643,34.823l14.334,107.38 c0.32,2.432,0.141,5.121-0.494,7.121h5.721c2.406,0,4.432-1.674,4.77-4.059l15.908-115.395c0.27-1.957,0.92-3.755,1.867-5.374 c5.018-8.553,17.955-8.538,22.949,0.013c0.947,1.619,1.596,3.448,1.891,5.407l15.906,115.347c0.338,2.387,2.361,4.061,4.771,4.061 h29.361c2.902,0,5.152-2.482,4.77-5.365l-19.215-144.012l38.881-35.437C480.036,298.634,480.036,274.271,465.007,259.242z M431.862,292.361l-12.283,12.307l-5.287-38.723c-0.158-1.146,1.215-1.822,2.025-1.01l15.545,15.545 C435.151,283.766,435.151,289.076,431.862,292.361z"></path> <path d="M256.376,126.5h-0.002c-20.479,0-37.078,16.519-37.078,36.999c0,20.479,16.6,37.001,37.078,37.001h0.002 c20.479,0,37.08-16.522,37.08-37.001C293.456,143.019,276.854,126.5,256.376,126.5z"></path> </g> </g></svg>
                        <span class="ml-3 roboto tracking-wide sm:text-lg">Contacts</span>
                    </a>
                </li>

                <!-- Management -->
                @if (auth()->user()->isAdmin())
                <li>
                    <button type="button" @click="setLastClicked('management')"
                        class="flex items-center py-1 px-2 w-full  transition duration-75 group rounded-mid nav-inactive-tab">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path
                                d="M18.75 12.75h1.5a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM12 6a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 6ZM12 18a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 18ZM3.75 6.75h1.5a.75.75 0 1 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM5.25 18.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 0 1.5ZM3 12a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 3 12ZM9 3.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM12.75 12a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM9 15.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap roboto tracking-wide sm:text-lg">Management</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <ul class=" mt-2 overflow-hidden space-y-2 border border-gray-300 dark:border-gray-700 rounded-mid "
                        x-collapse.duration.50 x-show="lastClicked === 'management'">

                        @can('viewAny', App\Models\User::class)
                        <li>
                            <a href="{{ route('user.index') }}" wire:navigate
                                class="flex items-center py-1 px-2 pl-11 w-full  transition duration-75 group {{ request()->routeIs('user.index') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                                </svg>

                                <span class="ml-2 roboto tracking-wide sm:text-lg">Users</span>
                            </a>
                        </li>
                        @endcan

                        <li>
                            <a href="{{ route('store.index') }}" wire:navigate
                                class="flex items-center py-1 px-2 pl-11 w-full  transition duration-75 group {{ request()->routeIs('store.index') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path
                                        d="M5.223 2.25c-.497 0-.974.198-1.325.55l-1.3 1.298A3.75 3.75 0 0 0 7.5 9.75c.627.47 1.406.75 2.25.75.844 0 1.624-.28 2.25-.75.626.47 1.406.75 2.25.75.844 0 1.623-.28 2.25-.75a3.75 3.75 0 0 0 4.902-5.652l-1.3-1.299a1.875 1.875 0 0 0-1.325-.549H5.223Z" />
                                    <path fill-rule="evenodd"
                                        d="M3 20.25v-8.755c1.42.674 3.08.673 4.5 0A5.234 5.234 0 0 0 9.75 12c.804 0 1.568-.182 2.25-.506a5.234 5.234 0 0 0 2.25.506c.804 0 1.567-.182 2.25-.506 1.42.674 3.08.675 4.5.001v8.755h.75a.75.75 0 0 1 0 1.5H2.25a.75.75 0 0 1 0-1.5H3Zm3-6a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75v-3Zm8.25-.75a.75.75 0 0 0-.75.75v5.25c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75v-5.25a.75.75 0 0 0-.75-.75h-3Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="ml-2 roboto tracking-wide sm:text-lg">Stores</span>
                            </a>
                        </li>

                    </ul>
                </li>
                @endif

                @if (Route::is('store.show') || Route::is('sale.create'))
                <li>
                    <a href="{{ route('sale.create', request()->route('store')) }}" @click="setLastClicked('sell')" wire:navigate
                    class="flex items-center py-1 px-2 font-semibold  rounded-mid group {{ Route::is('sale.create') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 576 512" class="size-6 fill-amber-500" >
                        <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM252 160c0 11 9 20 20 20l44 0 0 44c0 11 9 20 20 20s20-9 20-20l0-44 44 0c11 0 20-9 20-20s-9-20-20-20l-44 0 0-44c0-11-9-20-20-20s-20 9-20 20l0 44-44 0c-11 0-20 9-20 20z"/>
                    </svg>
                        <span class="ml-3 roboto tracking-wide sm:text-lg">{{ __('Sell in:') }} {{ request()->route('store')->invoices_prefix }}</span>
                    </a>
                </li>
                @endif

            </ul>

            <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
                <!-- Authentication -->
                <li>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                            class="flex items-center py-1 px-2 nav-inactive-tab rounded-mid  group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                            <span class="ml-4 roboto tracking-wide sm:text-lg">
                                {{ __('Log Out') }}
                            </span>
                        </a>
                    </form>
                </li>

            </ul>

            <div class="justify-center p-4 space-x-2 w-full flex bg-white dark:bg-gray-800 z-20">

                <a href="{{ route('profile.show') }}" wire:navigate
                    class="inline-flex justify-center p-2 text-gray-800 dark:text-gray-200 rounded cursor-pointer dark:hover:text-white hover:text-gray-700 dark:hover:bg-gray-600 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </a>

                {{-- <a href="#"
                    class="inline-flex justify-center p-2 text-gray-800 dark:text-gray-200 rounded cursor-pointer dark:hover:text-white hover:text-gray-700  dark:hover:bg-gray-600 hover:bg-gray-200">
                    <svg aria-hidden="true" class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a> --}}


                <div class="mt-2" data-tooltip-target="tooltip-mode">
                    <button type="button" x-bind:class="darkMode ? 'bg-sky-200' : 'bg-sky-900'"
                        x-on:click="darkMode = !darkMode"
                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-1 focus:ring-gray-200 focus:ring-offset-2 hover:bg-sky-500"
                        role="switch" aria-checked="false">
                        <span class="sr-only">mode toggle</span>

                        <span x-bind:class="darkMode ? 'translate-x-5 bg-sky-400' : 'translate-x-0 bg-black'"
                            class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full shadow ring-0 transition duration-200 ease-in-out">
                            <span
                                x-bind:class="darkMode ? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200'"
                                class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                                aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-yellow-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                </svg>
                            </span>
                            <span
                                x-bind:class="darkMode ?  'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100'"
                                class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                                aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-yellow-100" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                        clip-rule="evenodd" />
                                </svg>

                            </span>
                        </span>
                    </button>
                </div>
                <div id="tooltip-mode" role="tooltip"
                    class="inline-block absolute invisible z-10 py-2 px-3 text-sm roboto tracking-wide sm:text-lg text-white bg-gray-900 rounded-mid  shadow-sm opacity-0 transition-opacity duration-300 tooltip">
                    Dark/Light mode
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>
    </aside>
</div>
