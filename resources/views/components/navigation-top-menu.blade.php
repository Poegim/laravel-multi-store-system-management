<nav x-data="{ open: false, 
                lastClicked: localStorage.getItem('lastClickedButton') || 'none',
                setLastClicked(button) {

                    if (this.lastClicked === button) {
                        this.lastClicked = 'none'; // Toggle visibility on double click
                    } else {
                        this.lastClicked = button;
                    }
                    localStorage.setItem('lastClickedButton', this.lastClicked);
                } 
            }" 
     class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">

    @php
        $routeStore = request()->route('store');
    @endphp

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-gray-100 lg:bg-white">
        <div class="flex justify-between h-14 py-2">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center my-auto">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('logo.png') }}" width="150" alt="logo">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 ml-2 lg:flex my-auto">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" @click="setLastClicked('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-btn @click="setLastClicked('stores')" href="{{ route('store.index') }}"  :active="request()->routeIs('store.*')">
                        <a href="{{ route('store.index') }}">{{ __('Stores') }}</a>
                    </x-nav-btn>
                    <x-nav-btn  @click="setLastClicked('repository')" :active="request()->routeIs('category.*') || request()->routeIs('color.*') || request()->routeIs('brand.*') || request()->routeIs('product.*') || request()->routeIs('product-variant.*') || request()->routeIs('feature.*')">
                        {{ __('Repository') }}
                    </x-nav-btn>
                    <x-nav-link href="{{ route('stock.index') }}" @click="setLastClicked('stock')" :active="request()->routeIs('stock.show')">
                        {{ __('Stock') }}
                    </x-nav-link>
                    <x-nav-btn  @click="setLastClicked('documents')" :active="request()->routeIs('documents.*')">
                        {{ __('Documents') }}
                    </x-nav-btn>
                    <x-nav-btn  @click="setLastClicked('management')" :active="request()->routeIs('user.*') || request()->routeIs('contact.index')">
                        {{ __('Management') }}
                    </x-nav-btn>
                </div>
            </div>


            <div class="hidden lg:flex sm:items-center sm:ms-6">
    
                @if(isset($routeStore))
                    <div class="rounded px-4 mx-2 text-gray-900  font-semibold uppercase roboto" style="background-color: {{ $routeStore->color->value }};">
                        {{ $routeStore?->name }}
                    </div>
                @else
                    <div class="rounded mx-2 px-4 bg-white dark:bg-gray-700">
                        <span class="text-gray-900 dark:text-gray-200 font-semibold italic roboto">
                            {{ __('No Store Selected') }}
                        </span>
                    </div>
                @endif

                <div class="my-auto mt-2" data-tooltip-target="tooltip-mode">
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

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link class="flex gap-2" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 0 1 8.25-8.25.75.75 0 0 1 .75.75v6.75H18a.75.75 0 0 1 .75.75 8.25 8.25 0 0 1-16.5 0Z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M12.75 3a.75.75 0 0 1 .75-.75 8.25 8.25 0 0 1 8.25 8.25.75.75 0 0 1-.75.75h-7.5a.75.75 0 0 1-.75-.75V3Z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            {{ __('Dashboard') }}
                        </div>
            </x-responsive-nav-link>
            <x-responsive-nav-link @click="setLastClicked('stores')" :active="request()->routeIs('store.*')" class="flex gap-2">
                <svg class="size-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M5.535 7.677c.313-.98.687-2.023.926-2.677H17.46c.253.63.646 1.64.977 2.61.166.487.312.953.416 1.347.11.42.148.675.148.779 0 .18-.032.355-.09.515-.06.161-.144.3-.243.412-.1.111-.21.192-.324.245a.809.809 0 0 1-.686 0 1.004 1.004 0 0 1-.324-.245c-.1-.112-.183-.25-.242-.412a1.473 1.473 0 0 1-.091-.515 1 1 0 1 0-2 0 1.4 1.4 0 0 1-.333.927.896.896 0 0 1-.667.323.896.896 0 0 1-.667-.323A1.401 1.401 0 0 1 13 9.736a1 1 0 1 0-2 0 1.4 1.4 0 0 1-.333.927.896.896 0 0 1-.667.323.896.896 0 0 1-.667-.323A1.4 1.4 0 0 1 9 9.74v-.008a1 1 0 0 0-2 .003v.008a1.504 1.504 0 0 1-.18.712 1.22 1.22 0 0 1-.146.209l-.007.007a1.01 1.01 0 0 1-.325.248.82.82 0 0 1-.316.08.973.973 0 0 1-.563-.256 1.224 1.224 0 0 1-.102-.103A1.518 1.518 0 0 1 5 9.724v-.006a2.543 2.543 0 0 1 .029-.207c.024-.132.06-.296.11-.49.098-.385.237-.85.395-1.344ZM4 12.112a3.521 3.521 0 0 1-1-2.376c0-.349.098-.8.202-1.208.112-.441.264-.95.428-1.46.327-1.024.715-2.104.958-2.767A1.985 1.985 0 0 1 6.456 3h11.01c.803 0 1.539.481 1.844 1.243.258.641.67 1.697 1.019 2.72a22.3 22.3 0 0 1 .457 1.487c.114.433.214.903.214 1.286 0 .412-.072.821-.214 1.207A3.288 3.288 0 0 1 20 12.16V19a2 2 0 0 1-2 2h-6a1 1 0 0 1-1-1v-4H8v4a1 1 0 0 1-1 1H6a2 2 0 0 1-2-2v-6.888ZM13 15a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2Z" clip-rule="evenodd"/>
                </svg>
                {{ __('Stores') }}
                <svg :class="lastClicked === 'stores' ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 my-auto transition-transform duration-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </x-responsive-nav-link>
            <div x-show="lastClicked === 'stores'" class="mx-2 sm:mx-4 rounded border border-1 border-gray-200"  x-collapse>
                    <x-responsive-nav-link-small href="{{ route('store.index') }}" :active="request()->routeIs('store.index')" wire:navigate>
                        <span class="font-normal">{{ __('Stores index') }}</span>
                    </x-responsive-nav-link-small>
                @foreach ($stores as $store)
                    <x-responsive-nav-link-small href="{{ route('store.show', $store) }}" :active="url()->current() == route('store.show', $store->id)" wire:navigate>
                        <span class="font-normal italic">{{ $store->name }}</span>
                    </x-responsive-nav-link-small>
                @endforeach
            </div>
            <x-responsive-nav-link class="flex gap-2" @click="setLastClicked('repository')" :active="request()->routeIs('category.*') || request()->routeIs('color.*') || request()->routeIs('brand.*') || request()->routeIs('product.*') || request()->routeIs('product-variant.*') || request()->routeIs('feature.*')">
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
                {{ __('Repository') }}
                <svg :class="lastClicked === 'repository' ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 my-auto transition-transform duration-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </x-responsive-nav-link>
            <div x-show="lastClicked === 'repository'" class="mx-2 sm:mx-4 rounded border border-1 border-gray-200"  x-collapse>
                <x-responsive-nav-link-small href="{{ route('category.index') }}" :active="request()->routeIs('category.*')" wire:navigate>
                    <span class="font-normal">{{ __('Categories') }}</span>
                </x-responsive-nav-link-small>
                <x-responsive-nav-link-small href="{{ route('color.index') }}" :active="request()->routeIs('color.*')" wire:navigate>
                    <span class="font-normal">{{ __('Colors') }}</span>
                </x-responsive-nav-link-small>
                <x-responsive-nav-link-small href="{{ route('brand.index') }}" :active="request()->routeIs('brand.*')" wire:navigate>
                    <span class="font-normal">{{ __('Brands') }}</span>
                </x-responsive-nav-link-small>
                <x-responsive-nav-link-small href="{{ route('product.index') }}" :active="request()->routeIs('product.*')" wire:navigate>
                    <span class="font-normal">{{ __('Products') }}</span>
                </x-responsive-nav-link-small>
                <x-responsive-nav-link-small href="{{ route('product-variant.index') }}" :active="request()->routeIs('product-variant.*')" wire:navigate>
                    <span class="font-normal">{{ __('Product Variants') }}</span>
                </x-responsive-nav-link-small>
                <x-responsive-nav-link-small href="{{ route('feature.index') }}" :active="request()->routeIs('feature.*')" wire:navigate>
                    <span class="font-normal">{{ __('Features') }}</span>
                </x-responsive-nav-link-small>
            </div>
            <x-responsive-nav-link class="flex gap-2" @click="setLastClicked('stock')" :active="request()->routeIs('stock.show')">
                <svg fill="currentColor" class="size-6" version="1.2" baseProfile="tiny" id="inventory" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 256 230" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M61.2,106h37.4v31.2H61.2V106z M61.2,178.7h37.4v-31.2H61.2V178.7z M61.2,220.1h37.4v-31.2H61.2V220.1z M109.7,178.7H147 v-31.2h-37.4V178.7z M109.7,220.1H147v-31.2h-37.4V220.1z M158.2,188.9v31.2h37.4v-31.2H158.2z M255,67.2L128.3,7.6L1.7,67.4 l7.9,16.5l16.1-7.7v144h18.2V75.6h169v144.8h18.2v-144l16.1,7.5L255,67.2z"></path> </g></svg>
                <div>
                    {{ __('Stock') }}
                </div>
            </x-responsive-nav-link>
            <x-responsive-nav-link class="flex gap-2" @click="setLastClicked('documents')">
                <svg fill="currentColor" class="size-6" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M3,23H13a1,1,0,0,0,1-1V10a1,1,0,0,0-1-1H3a1,1,0,0,0-1,1V22A1,1,0,0,0,3,23ZM4,11h8V21H4Zm12,7V7H7A1,1,0,0,1,7,5H17a1,1,0,0,1,1,1V18a1,1,0,0,1-2,0ZM22,2V15a1,1,0,0,1-2,0V3H11a1,1,0,0,1,0-2H21A1,1,0,0,1,22,2Z"></path></g></svg>
                <div>
                    {{ __('Documents') }}
                </div>
            </x-responsive-nav-link>
            <x-responsive-nav-link class="flex gap-2" @click="setLastClicked('management')" :active="request()->routeIs('user.*') || request()->routeIs('contact.index') || request()->routeIs('store.index')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path
                    d="M18.75 12.75h1.5a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM12 6a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 6ZM12 18a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 18ZM3.75 6.75h1.5a.75.75 0 1 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM5.25 18.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 0 1.5ZM3 12a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 3 12ZM9 3.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM12.75 12a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM9 15.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                </svg>
                <div>
                    {{ __('Management') }}
                </div>
                <svg :class="lastClicked === 'management' ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 my-auto transition-transform duration-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </x-responsive-nav-link>
            <div x-show="lastClicked === 'management'" class="mx-2 sm:mx-4 rounded border border-1 border-gray-200" x-collapse>
                <x-responsive-nav-link-small href="{{ route('contact.index') }}" :active="request()->routeIs('contact.*')" wire:navigate>
                    <span class="font-normal">{{ __('Contacts') }}</span>
                </x-responsive-nav-link-small>
                <x-responsive-nav-link-small href="{{ route('user.index') }}" :active="request()->routeIs('user.*')" wire:navigate>
                    <span class="font-normal">{{ __('Users') }}</span>
                </x-responsive-nav-link-small>
            </div>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

            </div>
        </div>
    </div>

    <div class="hidden lg:flex h-8 my-1 px-4 bg-gray-100 dark:bg-gray-700 italic roboto">
        
        <div x-show="lastClicked === 'stores'" class="my-auto">
            @foreach ($stores as $store)
                <x-nav-link class="{{ url()->current() == route('store.show', $store->id) ? 'nav-active-tab' : 'nav-inactive-tab'}}" href="{{ route('store.show', $store) }}">
                    <span class="font-normal">{{ $store->name }}</span>
                </x-nav-link>
            @endforeach
        </div>

        <div x-show="lastClicked === 'repository'" class="my-auto">
            <x-nav-link href="{{ route('category.index') }}" class="{{ request()->routeIs('category.*') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                <span class="font-normal">{{ __('Categories') }}</span>
            </x-nav-link>

            <x-nav-link href="{{ route('color.index') }}" class="{{ request()->routeIs('color.*') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                <span class="font-normal">{{ __('Colors') }}</span>
            </x-nav-link>

            <x-nav-link href="{{ route('brand.index') }}" class="{{ request()->routeIs('brand.*') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                <span class="font-normal">{{ __('Brands') }}</span> 
            </x-nav-link>

            <x-nav-link href="{{ route('product.index') }}" class="{{ request()->routeIs('product.*') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                <span class="font-normal">{{ __('Products') }}</span>
            </x-nav-link>

            <x-nav-link href="{{ route('product-variant.index') }}" class="{{ request()->routeIs('product-variant.*') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                <span class="font-normal">{{ __('Product Variants') }}</span>
            </x-nav-link>

            <x-nav-link href="{{ route('feature.index') }}" class="{{ request()->routeIs('feature.*') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                <span class="font-normal">{{ __('Features') }}</span>
            </x-nav-link>

        </div>

        <div x-show="lastClicked === 'management'" class="my-auto">
            <x-nav-link href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                <span class="font-normal">{{ __('Contacts') }}</span>
            </x-nav-link>

            <x-nav-link href="{{ route('user.index') }}" class="{{ request()->routeIs('user.*') ? 'nav-active-tab' : 'nav-inactive-tab'}}">
                <span class="font-normal">{{ __('Users') }}</span>
            </x-nav-link>

        </div>

    </div>

</nav>