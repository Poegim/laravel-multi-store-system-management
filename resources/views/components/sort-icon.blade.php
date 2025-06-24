@props(['field', 'sortField', 'sortAsc'])

<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
     stroke="currentColor"
     class="inline w-4 h-4 ml-1 transition-transform duration-500 {{ $sortField === $field ? ($sortAsc ? 'rotate-0' : 'rotate-180') : 'opacity-30' }}">
    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25L12 15.75 4.5 8.25"/>
</svg>