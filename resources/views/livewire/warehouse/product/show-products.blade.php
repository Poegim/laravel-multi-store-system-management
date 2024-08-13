<div class=" py-2 sm:py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="w-full flex justify-end my-4 h-9 space-x-2">
            <x-input id="name" type="text" aria-placeholder="Search..." placeholder="Search..." wire:model.debounce.500ms.live="search" />
            <x-button wire:click="create()">
                {{ __('CREATE') }}
            </x-button>
        </div>
        
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex cursor-pointer" wire:click="sortBy('id')">
                                    <span class="uppercase">
                                        {{__('id')}}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                    fill="none" 
                                    viewBox="0 0 24 24" 
                                    stroke-width="1.5" 
                                    stroke="currentColor" 
                                    class="size-4 {{ $sortField === 'id' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex cursor-pointer" wire:click="sortBy('name')">
                                    <span class="uppercase" >
                                        {{__('name')}}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        fill="none" 
                                        viewBox="0 0 24 24" 
                                        stroke-width="1.5" 
                                        stroke="currentColor" 
                                        class="size-4 {{ $sortField === 'name' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                            {{__('slug')}}
                            </th>
                            <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                            {{__('category')}}
                            </th>
                            <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                            {{__('brand')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right">
                                {{__('action')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $item)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-6 py-2">
                               {{$item->id}}
                            </td>
                            <td scope="row"
                                class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex">
                                    <a href="#" class="my-auto" alt="{{$item->name}}" label="{{$item->name}}">{{Illuminate\Support\Str::limit($item->name, 30, '...')}}</a>
                                </div>
                            </td>
                            <td class="px-6 py-2 hidden lg:table-cell">
                                {{$item->slug}}
                            </td>
                            <td class="px-6 py-2 hidden lg:table-cell">
                                {{$item->category->plural_name}}
                            </td>
                            <td class="px-6 py-2 hidden lg:table-cell">
                                {{$item->brand->name}}
                            </td>
                            <td class="px-6 py-2 flex justify-end">
                                <x-buttons.edit-button wire:click="edit({{ $item->id }})">
                                    Edit
                                </x-buttons.edit-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class=" m-4">
                {{ $products->links() }}
            </div>            
        </div>

    </div>    
</div>
