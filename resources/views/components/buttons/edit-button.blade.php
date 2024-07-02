<button 
    {{ 
    $attributes->merge([
        'type' => 'submit', 
        'class' => 'text-green-800 dark:text-green-200 dark:hover:text-green-400 hover:text-green-600 transition-colors duration-300'
        ])
    }}>
    <x-fas-edit class="h-6 w-6"/>
</button>