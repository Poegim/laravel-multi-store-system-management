<div class="h-full" 
    x-data="{
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
    <aside id="default-sidebar"
        class="md:block w-full h-full md:w-64"
        aria-label="Sidenav">

        <div
            class="texd-md sm:text-sm font-semibold  overflow-y-auto py-5 sm:px-3 h-full bg-white md:border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700" >

            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}"   @click="setLastClicked('dashboard')" wire:navigate
                        class="flex items-center p-2 text-gray-900 dark:text-white dark:hover:bg-g hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg group {{ request()->routeIs('dashboard') ? 'nav-active-tab' : ''}}">
                        <x-carbon-dashboard-reference class="h-6 w-6" />
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>

                <!-- Management -->
                @if (auth()->user()->isAdmin())
                <li>
                    <button type="button" @click="setLastClicked('management')"
                        class="flex items-center p-2 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg"
                        >
                        <x-codicon-settings class="h-6 w-6"/>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Management</span>
                        <x-codicon-chevron-down class="h-6 w-6" />
                    </button>

                    <ul class=" mt-2 overflow-hidden space-y-2 border border-gray-300 dark:border-gray-700 rounded-lg" x-collapse.duration.100 x-show="lastClicked === 'management'">
                        
                        @can('viewAny', App\Models\User::class)                            
                            <li>
                                <a href="{{ route('user.index') }}"wire:navigate
                                    class="flex items-center p-2 pl-11 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{ request()->routeIs('user.index') ? 'nav-active-tab' : ''}}">
                                    <x-fas-users-gear class="h-6 w-6" /><span class="ml-2">Users</span>
                                </a>
                            </li>
                        @endcan

                        <li>
                            <a href="{{ route('store.index') }}"wire:navigate
                                class="flex items-center p-2 pl-11 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{ request()->routeIs('store.index') ? 'nav-active-tab' : ''}}">
                                <x-fas-store class="h-6 w-6"/> <span class="ml-2">Stores</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('category.index') }}"wire:navigate
                                class="flex items-center p-2 pl-11 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{ request()->routeIs('category.index') ? 'nav-active-tab' : ''}}">
                                <x-fas-list-ol class="h-6 w-6"/> <span class="ml-2">Categories</span>
                            </a>
                        </li>

                    </ul>
                </li>
                @endif

                <li>
                    <button type="button" @click="setLastClicked('repository')"
                        class="flex items-center p-2 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg"
                        >
                        <x-fas-database class="h-6 w-6" />
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Repository</span>
                        <x-codicon-chevron-down class="h-6 w-6" />
                    </button>

                    <ul class="mt-2 overflow-hidden space-y-2 border border-gray-300 dark:border-gray-700 rounded-lg" x-collapse.duration.100 x-show="lastClicked === 'repository'">
                        <li>
                            <a href="#" wire:navigate
                                class="flex items-center p-2 pl-11 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{-- request()->routeIs('store.index') ? 'nav-active-tab' : '' --}}">
                                <x-lucide-banana class="h-6 w-6"/> <span class="ml-2">Brands</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" wire:navigate
                                class="flex items-center p-2 pl-11 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{-- request()->routeIs('store.index') ? 'nav-active-tab' : '' --}}">
                                <x-eos-devices-other-o class="h-6 w-6"/> <span class="ml-2">Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" wire:navigate
                                class="flex items-center p-2 pl-11 w-full text-gray-900 transition duration-75 group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{-- request()->routeIs('store.index') ? 'nav-active-tab' : '' --}}">
                                <x-polaris-collection-featured-icon class="h-6 w-6"/> <span class="ml-2">Features</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Authentication -->
                <li>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}"
                                 @click.prevent="$root.submit();" class="flex items-center p-2 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg group">
                                 <x-carbon-logout class="h-6 w-6" />
                                 <span class="ml-4">
                                     {{ __('Log Out') }}
                                 </span>
                        </a>
                    </form>
                </li>
            </ul>


            <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
                
            </ul>

                    
        <div
            class="justify-center p-4 space-x-4 w-full flex bg-white dark:bg-gray-800 z-20">

            <a href="#" data-tooltip-target="tooltip-settings"
                class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark dark:hover:text-white hover:text-gray-900 dark:hover:bg-g hover:bg-gray-100ray-600">
                <svg aria-hidden="true" class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
            <div id="tooltip-settings" role="tooltip"
                class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
                Settings page
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>

            <div class="ml-2 mt-2" data-tooltip-target="tooltip-mode">
                <button type="button" x-bind:class="darkMode ? 'bg-slate-500' : 'bg-gray-700'"
                    x-on:click="darkMode = !darkMode"
                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-1 focus:ring-gray-200 focus:ring-offset-2 hover:bg-gray-900"
                    role="switch" aria-checked="false">
                    <span class="sr-only">Dark mode toggle</span>
                    <span x-bind:class="darkMode ? 'translate-x-5 bg-gray-700' : 'translate-x-0 bg-white'"
                        class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full shadow ring-0 transition duration-200 ease-in-out">
                        <span
                            x-bind:class="darkMode ? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200'"
                            class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                            aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-700" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                            </svg>
                        </span>
                        <span
                            x-bind:class="darkMode ?  'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100'"
                            class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                            aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" viewBox="0 0 20 20"
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
            class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
                Dark/Light mode
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
           
        </div>



        </div>

    </aside>
</div>
