<div class="h-full" x-data="{
                rolled: false,
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
    <aside id="default-sidebar" class="lg:block h-full transition-all duration-200" aria-label="Sidenav" :class="rolled ? 'w-10' : 'w-80'">
        <div

            class="sm:text-sm overflow-y-auto py-4 sm:px-2 h-full bg-white md:border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex">
                <img src="{{ asset('logo.png') }}" width="150" alt="logo" class="mx-auto mb-4 hidden" :class="rolled ? 'hidden' : 'md:block'">
                <button class="mb-auto  mt-1 mr-2 text-xl font-bold bg-gray-200 hover:bg-gray-300 dark:bg-slate-600 dark:hover:bg-slate-500 rounded p-1" @click="rolled = !rolled">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="size-4" :class="rolled ? '-rotate-90' : 'rotate-90'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
            </div>
            {{-- <div class="w-full text-center font-bold italic dark:text-gray-200 mb-4">LMSSM</div> --}}

            <ul class="space-y-2" :class="rolled ? 'hidden' : 'block'">
                <li>
                    <a href="{{ route('dashboard') }}"
                       @click="setLastClicked('dashboard')"
                       wire:navigate
                       class="flex items-center py-1 px-2 rounded-mid group {{ request()->routeIs('dashboard') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 0 1 8.25-8.25.75.75 0 0 1 .75.75v6.75H18a.75.75 0 0 1 .75.75 8.25 8.25 0 0 1-16.5 0Z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M12.75 3a.75.75 0 0 1 .75-.75 8.25 8.25 0 0 1 8.25 8.25.75.75 0 0 1-.75.75h-7.5a.75.75 0 0 1-.75-.75V3Z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-3 roboto tracking-wide sm:text-base">Dashboard</span>
                    </a>
                </li>

                <li>
                    <button type="button" @click="setLastClicked('stores')"
                        class="flex items-center py-1 px-2 w-full transition duration-75 group rounded-mid nav-inactive-tab">
                        <svg class="size-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5.535 7.677c.313-.98.687-2.023.926-2.677H17.46c.253.63.646 1.64.977 2.61.166.487.312.953.416 1.347.11.42.148.675.148.779 0 .18-.032.355-.09.515-.06.161-.144.3-.243.412-.1.111-.21.192-.324.245a.809.809 0 0 1-.686 0 1.004 1.004 0 0 1-.324-.245c-.1-.112-.183-.25-.242-.412a1.473 1.473 0 0 1-.091-.515 1 1 0 1 0-2 0 1.4 1.4 0 0 1-.333.927.896.896 0 0 1-.667.323.896.896 0 0 1-.667-.323A1.401 1.401 0 0 1 13 9.736a1 1 0 1 0-2 0 1.4 1.4 0 0 1-.333.927.896.896 0 0 1-.667.323.896.896 0 0 1-.667-.323A1.4 1.4 0 0 1 9 9.74v-.008a1 1 0 0 0-2 .003v.008a1.504 1.504 0 0 1-.18.712 1.22 1.22 0 0 1-.146.209l-.007.007a1.01 1.01 0 0 1-.325.248.82.82 0 0 1-.316.08.973.973 0 0 1-.563-.256 1.224 1.224 0 0 1-.102-.103A1.518 1.518 0 0 1 5 9.724v-.006a2.543 2.543 0 0 1 .029-.207c.024-.132.06-.296.11-.49.098-.385.237-.85.395-1.344ZM4 12.112a3.521 3.521 0 0 1-1-2.376c0-.349.098-.8.202-1.208.112-.441.264-.95.428-1.46.327-1.024.715-2.104.958-2.767A1.985 1.985 0 0 1 6.456 3h11.01c.803 0 1.539.481 1.844 1.243.258.641.67 1.697 1.019 2.72a22.3 22.3 0 0 1 .457 1.487c.114.433.214.903.214 1.286 0 .412-.072.821-.214 1.207A3.288 3.288 0 0 1 20 12.16V19a2 2 0 0 1-2 2h-6a1 1 0 0 1-1-1v-4H8v4a1 1 0 0 1-1 1H6a2 2 0 0 1-2-2v-6.888ZM13 15a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap roboto tracking-wide sm:text-base">Stores</span>
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
                                    <span class="ml-11 roboto tracking-wide sm:text-base">
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
                        <span class="flex-1 ml-3 text-left whitespace-nowrap roboto tracking-wide sm:text-base">Repository</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <ul class="mt-2 overflow-hidden space-y-2 border border-gray-300 dark:border-gray-700 rounded-mid "
                        x-collapse.duration.50 x-show="lastClicked === 'repository'">

                        <li>
                            <a href="{{ route('category.index') }}" wire:navigate
                                class="flex items-center py-1 px-2 pl-11 w-full transition duration-75 group {{ request()->routeIs('category.index') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                                <svg viewBox="0 0 48 48" class="size-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier"> <title>tree-structure</title>
                                        <g id="Layer_2" data-name="Layer 2"> <g id="invisible_box" data-name="invisible box">
                                            <rect fill="none"></rect> </g> <g id="Q3_icons" data-name="Q3 icons">
                                                <path d="M26,30H42a2,2,0,0,0,2-2V20a2,2,0,0,0-2-2H26a2,2,0,0,0-2,2v2H16V14h6a2,2,0,0,0,2-2V4a2,2,0,0,0-2-2H6A2,2,0,0,0,4,4v8a2,2,0,0,0,2,2h6V40a2,2,0,0,0,2,2H24v2a2,2,0,0,0,2,2H42a2,2,0,0,0,2-2V36a2,2,0,0,0-2-2H26a2,2,0,0,0-2,2v2H16V26h8v2A2,2,0,0,0,26,30Zm2-8H40v4H28ZM8,6H20v4H8ZM28,38H40v4H28Z">
                                                    </path> </g> </g> </g></svg>
                                <span class="ml-2 roboto tracking-wide sm:text-base">Categories</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('color.index') }}" wire:navigate
                                class="flex items-center py-1 px-2 pl-11 w-full transition duration-75 group {{ request()->routeIs('color.index') ? 'nav-active-tab' : 'nav-inactive-tab'}}"">
                                <svg viewBox="0 0 24 24" class="size-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14 12.5001C14 13.3285 13.3284 14.0001 12.5 14.0001C11.6716 14.0001 11 13.3285 11 12.5001C11 11.6717 11.6716 11.0001 12.5 11.0001C13.3284 11.0001 14 11.6717 14 12.5001Z" fill="#0F0F0F"></path> <path d="M16.5 10.0001C17.3284 10.0001 18 9.32854 18 8.50011C18 7.67169 17.3284 7.00011 16.5 7.00011C15.6716 7.00011 15 7.67169 15 8.50011C15 9.32854 15.6716 10.0001 16.5 10.0001Z" fill="currentColor"></path> <path d="M13 6.50011C13 7.32854 12.3284 8.00011 11.5 8.00011C10.6716 8.00011 10 7.32854 10 6.50011C10 5.67169 10.6716 5.00011 11.5 5.00011C12.3284 5.00011 13 5.67169 13 6.50011Z" fill="#currentColor"></path> <path d="M7.50001 12.0001C8.32844 12.0001 9.00001 11.3285 9.00001 10.5001C9.00001 9.67169 8.32844 9.00011 7.50001 9.00011C6.67158 9.00011 6.00001 9.67169 6.00001 10.5001C6.00001 11.3285 6.67158 12.0001 7.50001 12.0001Z" fill="#currentColor"></path> <path d="M14 17.5001C14 18.3285 13.3284 19.0001 12.5 19.0001C11.6716 19.0001 11 18.3285 11 17.5001C11 16.6717 11.6716 16.0001 12.5 16.0001C13.3284 16.0001 14 16.6717 14 17.5001Z" fill="#currentColor"></path> <path d="M7.50001 17.0001C8.32844 17.0001 9.00001 16.3285 9.00001 15.5001C9.00001 14.6717 8.32844 14.0001 7.50001 14.0001C6.67158 14.0001 6.00001 14.6717 6.00001 15.5001C6.00001 16.3285 6.67158 17.0001 7.50001 17.0001Z" fill="#currentColor"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5017 1.02215C15.4049 0.791746 19.5636 2.32444 21.8087 5.41131C22.5084 6.37324 22.8228 7.63628 22.6489 8.83154C22.471 10.054 21.7734 11.2315 20.4472 11.8945C19.6389 12.2987 18.7731 12.9466 18.2401 13.668C17.7158 14.3778 17.6139 14.9917 17.8944 15.5529C18.4231 16.6102 18.8894 17.9257 18.8106 19.1875C18.7699 19.8375 18.5828 20.4946 18.1664 21.0799C17.7488 21.6667 17.1448 22.1192 16.3714 22.4286C14.6095 23.1333 12.6279 23.1643 10.8081 22.8207C8.98579 22.4765 7.24486 21.7421 5.92656 20.8194C4.00568 19.4748 2.47455 17.6889 1.71371 15.4464C0.9504 13.1965 0.995912 10.5851 2.06024 7.65803C3.64355 3.30372 7.56248 1.25469 11.5017 1.02215ZM11.6196 3.01868C8.26589 3.21665 5.18483 4.9176 3.93984 8.34149C3.00414 10.9148 3.01388 13.0536 3.60768 14.8038C4.20395 16.5613 5.42282 18.0255 7.07347 19.1809C8.14405 19.9303 9.6169 20.5604 11.1792 20.8554C12.7442 21.151 14.3181 21.0959 15.6286 20.5716C16.308 20.2999 16.7678 19.8099 16.8145 19.0627C16.8606 18.3245 16.5769 17.3901 16.1056 16.4473C15.3639 14.9639 15.8542 13.5318 16.6315 12.4796C17.4002 11.4391 18.5455 10.6093 19.5528 10.1057C20.2266 9.76878 20.5747 9.19623 20.6697 8.54355C20.7686 7.86365 20.5831 7.12638 20.1913 6.58769C18.4364 4.17486 15.0093 2.81858 11.6196 3.01868Z" fill="#currentColor"></path> </g></svg>
                                <span class="ml-2 roboto tracking-wide sm:text-base">Colors</span>
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
                                <span class="ml-2 roboto tracking-wide sm:text-base">Brands</span>
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
                                <span class="ml-2 roboto tracking-wide sm:text-base">Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('product-variant.index') }}" wire:navigate
                                class="flex items-center py-1 px-2 pl-11 w-full  transition duration-75 group {{ request()->routeIs('product-variant.index') ? 'nav-active-tab' : 'nav-inactive-tab' }}">
                                <svg class="size-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 8v8m0-8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 8a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8-8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 0a4 4 0 0 1-4 4h-1a3 3 0 0 0-3 3"/>
                                  </svg>

                                <span class="ml-2 roboto tracking-wide sm:text-base">Variants</span>
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
                                <span class="ml-2 roboto tracking-wide sm:text-base">Features</span>
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
                       <span class="ml-3 roboto tracking-wide sm:text-base">Stock</span>
                    </a>
                    </a>
                </li>

                <li>
                    <a href="#"
                       @click="setLastClicked('documents')"
                       wire:navigate
                       class="flex items-center py-1 px-2 rounded-mid group nav-inactive-tab">
                       <svg fill="currentColor" class="size-6" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M3,23H13a1,1,0,0,0,1-1V10a1,1,0,0,0-1-1H3a1,1,0,0,0-1,1V22A1,1,0,0,0,3,23ZM4,11h8V21H4Zm12,7V7H7A1,1,0,0,1,7,5H17a1,1,0,0,1,1,1V18a1,1,0,0,1-2,0ZM22,2V15a1,1,0,0,1-2,0V3H11a1,1,0,0,1,0-2H21A1,1,0,0,1,22,2Z"></path></g></svg>
                       <span class="ml-3 roboto tracking-wide sm:text-base">Documents</span>
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
                    <span class="flex-1 ml-3 text-left whitespace-nowrap roboto tracking-wide sm:text-base">Management</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>

                    <ul class=" mt-2 overflow-hidden space-y-2 border border-gray-300 dark:border-gray-700 rounded-mid "
                    x-collapse.duration.50 x-show="lastClicked === 'management'">
                        <li>
                            <a href="{{ route('contact.index') }}"
                               wire:navigate
                               class="flex items-center py-1 px-2 pl-11 w-full  transition duration-75 group {{ request()->routeIs('contact.index') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                               <svg fill="currentColor" class="size-6" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>contacts</title> <path d="M2.016 28v2.016q0 0.832 0.576 1.408t1.408 0.576v-4h-1.984zM2.016 25.024q0 0.384 0.288 0.704t0.704 0.288h1.984q0.416 0 0.704-0.288t0.32-0.704-0.32-0.704-0.704-0.32h-1.984q-0.416 0-0.704 0.32t-0.288 0.704zM2.016 22.016h1.984v-12h-1.984v12zM2.016 7.008q0 0.416 0.288 0.704t0.704 0.288h1.984q0.416 0 0.704-0.288t0.32-0.704-0.32-0.704-0.704-0.288h-1.984q-0.416 0-0.704 0.288t-0.288 0.704zM2.016 4h1.984v-4q-0.832 0-1.408 0.608t-0.576 1.408v1.984zM6.016 28v2.016q0 0.832 0.576 1.408t1.408 0.576h20q0.832 0 1.408-0.576t0.608-1.408v-28q0-0.832-0.608-1.408t-1.408-0.608h-20q-0.832 0-1.408 0.608t-0.576 1.408v1.984q0.8 0 1.408 0.608t0.576 1.408v1.984q0 0.832-0.576 1.44t-1.408 0.576v12q0.8 0 1.408 0.576t0.576 1.408v2.016q0 0.832-0.576 1.408t-1.408 0.576zM12 21.024q0.224-1.344 1.056-2.464t2.048-1.792q-1.088-1.152-1.088-2.752v-2.016q0-1.632 1.152-2.816t2.848-1.184 2.816 1.184 1.184 2.816v2.016q0 1.6-1.12 2.752 1.184 0.672 2.048 1.792t1.056 2.464q0 1.248-0.864 2.112t-2.144 0.864h-5.984q-1.248 0-2.144-0.864t-0.864-2.112z"></path> </g></svg>
                               <span class="ml-3 roboto tracking-wide sm:text-base">Contacts</span>
                            </a>
                        </li>

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

                                <span class="ml-2 roboto tracking-wide sm:text-base">Users</span>
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
                                <span class="ml-2 roboto tracking-wide sm:text-base">Stores</span>
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
                        <span class="ml-3 roboto tracking-wide sm:text-base">{{ __('Sell in:') }} {{ request()->route('store')->invoices_prefix }}</span>
                    </a>
                </li>
                @endif

            </ul>

            <ul :class="rolled ? 'hidden' : 'block'" class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
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
                            <span class="ml-4 roboto tracking-wide sm:text-base">
                                {{ __('Log Out') }}
                            </span>
                        </a>
                    </form>
                </li>

            </ul>

            <div :class="rolled ? 'hidden' : 'block'" class="justify-center p-4 space-x-2 w-full flex bg-white dark:bg-gray-800 z-20">

                <a href="{{ route('profile.show') }}" wire:navigate
                    class="inline-flex justify-center p-2 text-gray-800 dark:text-gray-200 rounded cursor-pointer dark:hover:text-white hover:text-gray-700 dark:hover:bg-gray-600 hover:bg-gray-100">

                    <img src="{{ asset(auth()->user()->profile_photo_url) }}" alt="{{ auth()->user()->name }}"
                                class="rounded-full w-12 h-12 md:h-8 md:w-8 object-cover mr-2">
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


                <div class="my-auto" data-tooltip-target="tooltip-mode">
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
                    class="inline-block absolute invisible z-10 py-2 px-3 text-sm roboto tracking-wide sm:text-base text-white bg-gray-900 rounded-mid  shadow-sm opacity-0 transition-opacity duration-300 tooltip">
                    Dark/Light mode
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>
    </aside>
</div>
