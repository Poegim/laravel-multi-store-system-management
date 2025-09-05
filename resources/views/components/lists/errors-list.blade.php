<div x-data="{ open: true }" x-show="open"
    class="flex p-4 mb-4 text-sm text-red-800 rounded-md sm:rounded bg-red-50 dark:bg-gray-900 dark:text-red-400 relative"
    role="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        fill="currentColor" viewBox="0 0 20 20">
        <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <span class="sr-only">{{__('Errors detected!')}}</span>
    <div>
        <span class="font-medium">{{ $title ?? __('Ensure that these requirements are met:') }}</span>
        <ul class="mt-1.5 list-disc list-inside">
            {{ $slot }}
        </ul>
    </div>

    <!-- Close button -->
    <button @click="open = false" type="button"
        class="absolute top-2 right-2 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200">
        &times;
    </button>
</div>
