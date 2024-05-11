<button 
    {{ 
    $attributes->merge([
        'type' => 'submit', 
        'class' => 'text-white hover:bg-indigo-500 dark:hover:bg-indigo-500 font-medium text-sm px-5 py-2.5 me-2'
        ]) 
    }}
    >
    
    {{$slot}}
</button>