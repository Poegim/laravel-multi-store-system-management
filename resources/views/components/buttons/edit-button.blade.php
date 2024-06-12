<button 
    {{ 
    $attributes->merge([
        'type' => 'submit', 
        'class' => 'text-blue-500 dark:text-blue-200 dark:hover:text-blue-400 hover:text-blue-800 transition-colors duration-300'
        ])
    }}>
    <x-fas-edit class="h-6 w-6"/>
</button>