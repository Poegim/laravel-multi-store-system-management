<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


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

<body class="font-sans antialiased bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800"
    x-data="{ darkMode: true }" x-init="
    if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      localStorage.setItem('darkMode', JSON.stringify(true));
    }
    darkMode = JSON.parse(localStorage.getItem('darkMode'));
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" x-cloak>

    @props(['headerBgColor' => 'bg-white dark:bg-gray-800'])

    <div x-bind:class="{'dark' : darkMode === false}">

        <x-banner />

        <div class="bg-gray-100 dark:bg-gray-900 h-full min-h-screen">



            {{-- <div class="lg:hidden">
                @livewire('navigation-menu')
            </div>

            <div class="hidden lg:block">
                <x-sidebar />
            </div> --}}

            
            <div class="w-full">
                <x-navigation-top-menu />
                <!-- Page Heading -->
                @if (isset($header))
                <header class="shadow {{ $headerBgColor }}">
                    <div class="mx-auto">
                        {{ $header }}
                    </div>
                </header>
                @endif

                <!-- Page Content -->
                <main>
                    <div class="py-1 sm:py-2 dark:text-gray-200">
                        <div class="mx-auto sm:px-4">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>

        </div>
    </div>



    @stack('modals')
    @livewireScripts
</body>

</html>
