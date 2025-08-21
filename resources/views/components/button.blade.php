<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => '
        inline-flex items-center justify-center
        px-6 py-2
        text-sm font-semibold uppercase tracking-wide
        rounded shadow-sm
        bg-primary-600 text-white
        hover:bg-primary-700
        focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2
        transition-colors duration-150
        dark:bg-primary-500 dark:text-white dark:hover:bg-primary-600
    '
]) }}>
    {{ $slot }}
</button>
