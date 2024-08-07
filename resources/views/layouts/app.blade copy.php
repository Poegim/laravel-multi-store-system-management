<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

</head>

<body class="font-sans antialiased bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800" x-data="{ darkMode: true }" x-init="
    if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      localStorage.setItem('darkMode', JSON.stringify(true));
    }
    darkMode = JSON.parse(localStorage.getItem('darkMode'));
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" x-cloak>
    
    <div x-bind:class="{'dark' : darkMode === true}">     
        
        
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            
            <div>
                @livewire('navigation-menu')
            </div>
            
            <div class="md:grid grid-cols-2 bg-red-500">
                <x-banner />

                <div class="hidden md:absolute md:flex bottom-0 top-0 h-full bg-green-500">
                    <x-sidebar />
                </div>

                <div class="md:ml-64 w-full bg-orange-400">
                    
                    <!-- Page Heading -->
                    @if (isset($header))
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                    @endif
                    
                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </div>



    @stack('modals')
    @livewireScripts
</body>

</html>
