@props(['class' => 'bg-white dark:bg-gray-900 sm:rounded shadow-sm'])
<div {{ $attributes->merge(['class' => $class]) }}>
    <div class="p-2 md:p-4">
        {{ $slot }}
    </div>
</div>
