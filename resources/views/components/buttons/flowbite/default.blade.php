<button 
    {{ 
    $attributes->merge([
        'type' => 'submit', 
        'class' => 'text-white bg-blue-800 dark:bg-blue-800 hover:bg-blue-900 dark:hover:bg-blue-900 font-medium text-sm px-5 py-2.5 me-2'
        ]) 
    }}
    >
    
    {{$slot}}
</button>