<div>

    @if ((!$category_filter) || (!$brand_filter))
    <!-- If there was passed category filter dont show create button -->
    <div class="index-create-btn-div">
        <x-input id="name" type="text" aria-placeholder="Search..." placeholder="Search..."
            wire:model.debounce.500ms.live="search" />
        <a href="{{route('product.create')}}" wire:navigate>
            <x-button>
                {{ __('CREATE') }}
            </x-button>
        </a>
    </div>
    @endif

    <x-window>
        @if (($category_filter) || ($brand_filter))
        <!-- If there was passed category or brand filter -->
        <div class="w-full">
            <h2 class="px-4 uppercase font-semibold roboto text-gray-700 dark:text-gray-300">
                Filtered Products
            </h2>
        </div>
        @endif


        <div class="overflow-x-auto">
            <table
                class="rounded-2xl overflow-hidden min-w-full text-xs text-left text-gray-700 dark:text-gray-300 border dark:border-gray-700">
                <thead class="uppercase bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                    <th scope="col" class="px-4 py-2 sm:py-3">
                        <div class="flex cursor-pointer" wire:click="sortBy('id')">
                            <span class="uppercase">
                                {{__('id')}}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="size-4 {{ $sortField === 'id' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-2 sm:py-3">
                        <div class="flex cursor-pointer" wire:click="sortBy('name')">
                            <span class="uppercase">
                                {{__('name')}}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="size-4 {{ $sortField === 'name' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-2 sm:py-3">
                        <div class="flex cursor-pointer" wire:click="sortBy('brand')">
                            <span class="uppercase">
                                {{__('brand')}}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="size-4 {{ $sortField === 'brand' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-2 sm:py-3 hidden lg:table-cell">
                        <div class="flex cursor-pointer" wire:click="sortBy('suggested_retail_price')">
                            <span class="uppercase">
                                {{__('SRP')}}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="size-4 {{ $sortField === 'suggested_retail_price' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-2 sm:py-3 hidden lg:table-cell">
                        <div class="flex cursor-pointer" wire:click="sortBy('product_variants_count')">
                            <span class="uppercase">
                                {{__('variants')}}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="size-4 {{ $sortField === 'product_variants_count' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-2 sm:py-3 hidden lg:table-cell">
                        {{__('category')}}
                    </th>
                    <th scope="col" class="px-4 py-2 sm:py-3 hidden lg:table-cell">
                        {{__('created_by')}}
                    </th>
                    <th scope="col" class="px-4 py-2 sm:py-3 text-right">

                    </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                <tr class="bg-white dark:bg-gray-800 border-t hover:bg-gray-100 dark:hover:bg-gray-700 transition" 
                        wire:key="row-{{ $product->id }}">
                        <td class="px-4 py-2 dark:text-gray-100 font-thin">
                            {{$product->id}}
                        </td>

                        <td scope="row"
                            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex">
                                <a href="{{ route('product.show', [$product->brand, $product]) }}"
                                    class="link my-auto text-sm" alt="{{$product->name}}"
                                    label="{{$product->name}}">{{Illuminate\Support\Str::limit($product->name, 30, '...')}}</a>
                            </div>
                        </td>

                        <td scope="row"
                            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex">
                                <a href="{{ route('brand.show', $product->brand->slug)}}" class="link my-auto text-sm"
                                    alt="{{$product->brand->name}}"
                                    label="{{$product->brand->name}}">{{Illuminate\Support\Str::limit($product->brand->name, 30, '...')}}</a>
                            </div>
                        </td>

                        <td class="px-4 py-2 hidden lg:table-cell">
                            {{$product->formattedSRP()}}
                        </td>

                        <td class="px-4 py-2 hidden lg:table-cell">
                            {{$product->product_variants_count}}
                        </td>

                        <td class="px-4 py-2 hidden lg:table-cell">
                            {{$product->category->plural_name}}
                        </td>

                        <td class="px-4 py-2 hidden lg:table-cell">
                            <div class="flex">
                                <img src="{{ $product->user->profile_photo_url }}" alt="{{ $product->user->name }}"
                                    class="rounded-full md:h-6 md:w-6 object-cover mr-2 my-auto mb-4 md:mb-0">
                                <div class="my-auto">
                                    {{$product->user->name}}
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-2 flex justify-end">
                            <a href="{{route('product.edit', $product)}}" wire:navigate>
                                <x-buttons.edit-button>
                                    Edit
                                </x-buttons.edit-button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class=" m-4">
            {{ $products->links(data: ['scrollTo' => false]) }}
        </div>
    </x-window>

</div>
