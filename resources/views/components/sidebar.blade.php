<div x-data="{ open: true }" class="z-40">
    <button @click="open = ! open" data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
        aria-controls="default-sidebar" type="button"
        class="fixed top-2 right-2 z-50 inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg border border-1 border-slate-700 sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 dark:bg-gray-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside :class="open ? 'sm:translate-x-0' : ''" id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidenav">
        <div
            class="overflow-y-auto py-5 px-3 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <ul class="space-y-2">
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <x-carbon-dashboard-reference class="h-6 w-6 text-gray-400" />
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-management" data-collapse-toggle="dropdown-management">
                        <x-codicon-settings class="w-6 h-6 text-gray-400"/>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Management</span>
                        <x-codicon-chevron-down class="h-6 w-6" />
                    </button>
                    <ul id="dropdown-management" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{route('users.index')}}"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <x-fas-users-gear class="h-6 w-6 text-gray-400" /><span class="ml-2">Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <x-fas-store class="h-6 w-6 text-gray-400"/> <span class="ml-2">Stores</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Pages</span>
                        <x-codicon-chevron-down class="h-6 w-6" />
                    </button>
                    <ul id="dropdown-pages" class="hidden py-2 space-y-2">
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Settings</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Kanban</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Calendar</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-sales" data-collapse-toggle="dropdown-sales">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Sales</span>
                        <x-codicon-chevron-down class="h-6 w-6" />
                    </button>
                    <ul id="dropdown-sales" class="hidden py-2 space-y-2">
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Products</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Billing</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Invoice</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                            </path>
                            <path
                                d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Messages</span>
                        <span
                            class="inline-flex justify-center items-center w-5 h-5 text-xs font-semibold rounded-full text-primary-800 bg-primary-100 dark:bg-primary-200 dark:text-primary-800">
                            6
                        </span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-authentication" data-collapse-toggle="dropdown-authentication">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Authentication</span>
                        <x-codicon-chevron-down class="h-6 w-6" />
                    </button>
                    <ul id="dropdown-authentication" class="hidden py-2 space-y-2">
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Sign
                                In</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Sign
                                Up</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Forgot
                                Password</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-3">Docs</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                            </path>
                        </svg>
                        <span class="ml-3">Components</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-3">Help</span>
                    </a>
                </li>
            </ul>
        </div>
        <div
            class="hidden absolute bottom-0 left-0 justify-center p-4 space-x-4 w-full lg:flex bg-white dark:bg-gray-800 z-20 border-r border-gray-200 dark:border-gray-700">
            <a href="#" data-tooltip-target="tooltip-management"
                class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-600">
                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                    </path>
                </svg>
            </a>
            <div id="tooltip-management" role="tooltip"
            class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
                Management page
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <a href="#" data-tooltip-target="tooltip-settings"
                class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
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
    </aside>
</div>
