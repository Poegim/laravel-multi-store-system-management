<button 
    {{ 
    $attributes->merge([
        'type' => 'submit', 
        'class' => 'text-gray-600 dark:text-gray-200 dark:hover:text-gray-400 hover:text-gray-800 transition-colors duration-300'
        ])
    }}>
    <x-fas-edit class="h-6 w-6"/>
</button>