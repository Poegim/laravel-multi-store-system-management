@props(['class' => 'bg-white dark:bg-gray-900 sm:rounded-2xl shadow-sm']) {{-- Możesz dodać klasę jako parametr, ale jest to opcjonalne --}}
<div {{ $attributes->merge(['class' => $class]) }}>
    <div class="p-2">
        {{ $slot }}
    </div>
</div>
