@props(['class' => '']) {{-- Możesz dodać klasę jako parametr, ale jest to opcjonalne --}}
<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 shadow-xl sm:rounded-md' . $class]) }}>
    <div class="m-2 p-2">
        {{ $slot }}
    </div>
</div>
