@props(['class' => 'bg-white dark:bg-gray-900 sm:rounded-2xl shadow-sm'])
<div {{ $attributes->merge(['class' => $class]) }}>
    <div class="p-2 md:p-4">
        {{ $slot }}
    </div>
</div>
