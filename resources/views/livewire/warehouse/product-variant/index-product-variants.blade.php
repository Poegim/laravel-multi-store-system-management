<div >

    <div class="index-create-btn-div">
        <div x-data="{ hover: false }" class="inline-block">
            <button 
                wire:click="resetSearch"
                @mouseenter="hover = true" 
                @mouseleave="hover = false" 
                :class="{ 'w-24': hover, 'w-12': !hover }" 
                class="flex text-center items-center px-4 py-2 bg-gray-200 rounded-mid hover:bg-gray-300 overflow-hidden transition-all duration-300">
                <svg class="size-6" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier"> 
                        <title>reset</title> 
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> 
                            <g id="Combined-Shape" fill="#000000" transform="translate(74.806872, 64.000000)"> 
                                <path d="M351.859794,42.6666667 L351.859794,85.3333333 L283.193855,85.3303853 C319.271288,116.988529 341.381875,163.321355 341.339886,213.803851 C341.27474,291.98295 288.098183,360.121539 212.277591,379.179704 C136.456999,398.237869 57.3818117,363.341907 20.3580507,294.485411 C-16.6657103,225.628916 -2.17003698,140.420413 55.5397943,87.68 C63.6931909,100.652227 75.1888658,111.189929 88.8197943,118.186667 C59.4998648,141.873553 42.4797783,177.560832 42.5264609,215.253333 C43.5757012,285.194843 100.577082,341.341203 170.526461,341.333333 C234.598174,342.388718 289.235113,295.138227 297.4321,231.584253 C303.556287,184.101393 282.297007,138.84385 245.195596,112.637083 L245.193128,192 L202.526461,192 L202.526461,42.6666667 L351.859794,42.6666667 Z M127.859794,-1.42108547e-14 C151.423944,-1.42108547e-14 170.526461,19.1025173 170.526461,42.6666667 C170.526461,66.230816 151.423944,85.3333333 127.859794,85.3333333 C104.295645,85.3333333 85.1931276,66.230816 85.1931276,42.6666667 C85.1931276,19.1025173 104.295645,-1.42108547e-14 127.859794,-1.42108547e-14 Z"> 
                                </path> 
                            </g> 
                        </g> 
                    </g>
                </svg>
                <span 
                    class="ml-2 whitespace-nowrap dark:text-gray-900"
                    x-show="hover"
                    x-transition.opacity
                >
                    reset
                </span>
            </button>
        </div>
        
        <select wire:model="searchBy" name="searchBy" id="searchBy"
            class="input-jetstream text-gray-700 h-10 w-10 sm:w-auto">
            <option value="name" >{{__('name')}}</option>
            <option value="product.name">{{__('product_name')}}</option>
            <option value="ean">{{__('ean')}}</option>
        </select>
        <x-input 
            class="h-10 w-full transition-all duration-300"
            id="name" 
            type="text" 
            aria-placeholder="Search..." 
            placeholder="Search..." 
            wire:model.debounce.500ms.live="search" 
        />

        <a href="{{route('product-variant.create')}}" wire:navigate>
            <x-button class="h-10">{{__('create')}}</x-button>
        </a>

    </div>

    <x-window>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase">
                    <tr class="text-black dark:text-white">
                        <th scope="col" class="px-1 sm:px-2 py-1 sm:py-3">
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
                        <th scope="col" class="px-1 sm:px-2 py-1 sm:py-3">
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
                        <th scope="col" class="px-1 sm:px-2 py-1 sm:py-3">
                            <div class="flex cursor-pointer" wire:click="sortBy('suggested_retail_price')">
                                <span class="uppercase" >
                                    {{__('SRP')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-4 {{ $sortField === 'suggested_retail_price' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-1 sm:px-2 py-1 sm:py-3">
                            <div class="flex cursor-pointer" wire:click="sortBy('stock_items_count')">
                                <span class="uppercase" >
                                    {{__('COUNT')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-4 {{ $sortField === 'stock_items_count' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-1 sm:px-2 py-1 sm:py-3 hidden lg:table-cell">
                        {{__('product name')}}
                        </th>
                        <th scope="col" class="px-1 sm:px-2 py-1 sm:py-3 hidden xl:table-cell">
                            {{__('product id')}}
                            </th>
                        <th scope="col" class="px-1 sm:px-2 py-1 sm:py-3 hidden xl:table-cell">
                        {{__('ean')}}
                        </th>
                        <th scope="col" class="px-1 sm:px-2 py-1 sm:py-3 hidden xl:table-cell">
                        {{__('created_by')}}
                        </th>
                        <th scope="col" class="px-1 sm:px-2 py-1 sm:py-3 text-right">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productVariants as $item)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td scope="row"
                            class="font-tdin px-1 sm:px-2 py-1 text-gray-900 whitespace-nowrap dark:text-white">
                                {{$item->id}}
                        </td>
                        <td scope="row"
                            class="px-1 sm:px-2 py-1 text-gray-900 dark:text-white">
                            <div class="flex">
                                <a href="{{route('product-variant.show', $item->id)}}" label="{{$item->name}}" class="my-auto link">{{Str::limit($item->name, 25, '...')}}</a>
                            </div>
                        </td>

                        <td scope="row"
                            class="px-1 sm:px-2 py-1 text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->formattedSRP() }}
                        </td>
                        <td scope="row"
                            class="px-1 sm:px-2 py-1 text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->stock_items_count }}
                        </td>

                        <td class="px-1 sm:px-2 py-1 hidden lg:table-cell">
                            {{$item->product->name}}
                        </td>
                        <td class="px-1 sm:px-2 py-1 hidden xl:table-cell">
                            {{$item->product->id}}
                        </td>
                        <td class="px-1 sm:px-2 py-1 hidden xl:table-cell">
                            {{$item->ean}}
                        </td>
                        <td class="px-1 sm:px-2 py-1 hidden xl:table-cell">
                            <div class="flex">
                                <img src="{{ $item->user->profile_photo_url }}" alt="{{ $item->user->name }}"
                                class="rounded-full w-12 h-12 md:h-8 md:w-8 object-cover mr-2 my-auto mb-4 md:mb-0">
                                <div class="my-auto">
                                    {{$item->user->name}}
                                </div>
                            </div>
                        </td>
                        <td class="px-1 sm:px-2 py-1 flex justify-end">
                            <a href="{{ route('product-variant.edit', $item->id) }}">
                                <x-buttons.edit-button>
                                    {{__('edit')}}
                                </x-buttons.edit-button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        <div class=" m-4">
            {{ $productVariants->links() }}
        </div>
    </x-window>
</div>
