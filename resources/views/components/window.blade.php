@props(['class' => '']) {{-- Możesz dodać klasę jako parametr, ale jest to opcjonalne --}}
<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 shadow-xl sm:rounded-mid ' . $class]) }}>
    <div class="m-2 sm:m-4 py-2 md:px-2 md:py-4 rounded-mid">
        {{ $slot }}
    </div>
</div>
