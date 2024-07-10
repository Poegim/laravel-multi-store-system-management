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
    <aside id="default-sidebar" class="md:block w-full h-full md:w-64" aria-label="Sidenav">


        <div
            class="texd-md sm:text-sm font-semibold  overflow-y-auto py-5 sm:px-3 h-full bg-white md:border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">

            <img src="{{ asset('logo.png') }}" alt="logo" class="mx-auto mb-4 hidden md:block">

            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}" @click="setLastClicked('dashboard')" wire:navigate
                        class="flex items-center p-2 text-gray-900 dark:text-white dark:hover:bg-g hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg group {{ request()->routeIs('dashboard') ? 'nav-active-tab' : ''}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                        </svg>                      
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>

                <!-- Management -->
                @if (auth()->user()->isAdmin())
                <li>
                    <button type="button" @click="setLastClicked('management')"
                        class="flex items-center p-2 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                        </svg>                          
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Management</span>
                    </button>

                    <ul class=" mt-2 overflow-hidden space-y-2 border border-gray-300 dark:border-gray-700 rounded-lg"
                        x-collapse.duration.100 x-show="lastClicked === 'management'">

                        @can('viewAny', App\Models\User::class)
                        <li>
                            <a href="{{ route('user.index') }}" wire:navigate
                                class="flex items-center p-2 pl-11 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('user.index') ? 'nav-active-tab' : ''}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>                                  
                                <span class="ml-2">Users</span>
                            </a>
                        </li>
                        @endcan

                        <li>
                            <a href="{{ route('store.index') }}" wire:navigate
                                class="flex items-center p-2 pl-11 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('store.index') ? 'nav-active-tab' : ''}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                </svg>                                  
                                <span class="ml-2">Stores</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('category.index') }}" wire:navigate
                                class="flex items-center p-2 pl-11 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('category.index') ? 'nav-active-tab' : ''}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                                </svg>                                  
                                <span class="ml-2">Categories</span>
                            </a>
                        </li>

                    </ul>
                </li>
                @endif

                <li>
                    <button type="button" @click="setLastClicked('repository')"
                        class="flex items-center p-2 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Repository</span>
                    </button>

                    <ul class="mt-2 overflow-hidden space-y-2 border border-gray-300 dark:border-gray-700 rounded-lg"
                        x-collapse.duration.100 x-show="lastClicked === 'repository'">
                        <li>
                            <a href="#" wire:navigate
                                class="flex items-center p-2 pl-11 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{-- request()->routeIs('store.index') ? 'nav-active-tab' : '' --}}">
                                <svg fill="#000000" class="size-6 fill-gray-900 dark:fill-white" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 507.2 507.2" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M380.8,240c-17.6-22.4-33.6-43.2-40-67.2c-1.6-4.8-3.2-9.6-4.8-14.4c-11.2-40-22.4-78.4-65.6-84.8V40c0-6.4,9.6-8,16-8 c9.6,0,16-6.4,16-16c0-9.6-6.4-16-16-16c-33.6,0-48,20.8-48,40v30.4c-44.8,8-56,44.8-67.2,84.8c-1.6,4.8-3.2,9.6-4.8,14.4 c-6.4,27.2-22.4,48-40,70.4c-25.6,32-52.8,68.8-52.8,120c0,88,70.4,147.2,179.2,147.2h1.6c108.8,0,179.2-57.6,179.2-147.2 C433.6,308.8,404.8,272,380.8,240z M256,475.2h-1.6c-72,0-147.2-30.4-147.2-115.2c0-40,22.4-70.4,46.4-100.8 c17.6-24,36.8-48,46.4-78.4c1.6-4.8,3.2-11.2,4.8-16c11.2-46.4,17.6-62.4,49.6-62.4s38.4,16,51.2,62.4c1.6,4.8,3.2,9.6,4.8,16 c9.6,30.4,27.2,54.4,46.4,78.4c24,30.4,46.4,59.2,46.4,100.8C403.2,444.8,326.4,475.2,256,475.2z"></path> </g> </g> </g></svg>
                                <span class="ml-2">Brands</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" wire:navigate
                                class="flex items-center p-2 pl-11 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{-- request()->routeIs('store.index') ? 'nav-active-tab' : '' --}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                                </svg>                                  
                                <span class="ml-2">Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" wire:navigate
                                class="flex items-center p-2 pl-11 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{-- request()->routeIs('store.index') ? 'nav-active-tab' : '' --}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z" />
                                </svg>                                  
                                <span class="ml-2">Features</span>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>


            <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
                <!-- Authentication -->
                <li>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                            class="flex items-center p-2 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>                              
                            <span class="ml-4">
                                {{ __('Log Out') }}
                            </span>
                        </a>
                    </form>
                </li>

            </ul>


            <div class="justify-center p-4 space-x-2 w-full flex bg-white dark:bg-gray-800 z-20">

                <a href="{{ route('profile.show') }}" wire:navigate
                    class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark dark:hover:text-white hover:text-gray-900 dark:hover:bg-gray-600 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>                      
                </a>

                <a href="#"
                    class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark dark:hover:text-white hover:text-gray-900 dark:hover:bg-gray-600 hover:bg-gray-100">
                    <svg aria-hidden="true" class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>


                <div class="mt-2" data-tooltip-target="tooltip-mode">
                    <button type="button" x-bind:class="darkMode ? 'bg-sky-900' : 'bg-sky-200'"
                        x-on:click="darkMode = !darkMode"
                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-1 focus:ring-gray-200 focus:ring-offset-2 hover:bg-sky-500"
                        role="switch" aria-checked="false">
                        <span class="sr-only">Dark mode toggle</span>
                        <span x-bind:class="darkMode ? 'translate-x-5 bg-black' : 'translate-x-0 bg-sky-900'"
                            class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full shadow ring-0 transition duration-200 ease-in-out">
                            <span
                                x-bind:class="darkMode ? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200'"
                                class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                                aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span
                                x-bind:class="darkMode ?  'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100'"
                                class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                                aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-yellow-500"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                </svg>
                            </span>
                        </span>
                    </button>
                </div>
                <div id="tooltip-mode" role="tooltip"
                    class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
                    Dark/Light mode
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>
    </aside>
</div>
