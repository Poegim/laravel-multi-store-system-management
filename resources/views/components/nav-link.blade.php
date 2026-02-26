@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center p-2 bg-gray-900 text-sm font-medium leading-5 text-gray-200 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-300 ease-in-out'
            : 'inline-flex items-center p-2 text-sm font-medium leading-5 text-gray-900 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-300 transition duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} wire:navigate>
    {{ $slot }}
</a>
