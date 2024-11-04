<div >

    @if ((!$category_filter) || (!$brand_filter))
    <!-- If there was passed category filter dont show create button -->
    <div class="w-full flex justify-end my-1 sm:my-4 h-9 space-x-2 pr-2 sm:pr-0">
        <x-input id="name" type="text" aria-placeholder="Search..." placeholder="Search..." wire:model.debounce.500ms.live="search" />
        <a href="{{route('product.create')}}" wire:navigate>
            <x-button>
                {{ __('CREATE') }}
            </x-button>
        </a>
    </div>
    @endif

    <x-window>
        @if ($category_filter)
        <!-- If there was passed category filter show category name we are filtering -->
        <div class="w-full">
            <h2 class="text-sm px-4 uppercase font-semibold roboto text-gray-700 dark:text-gray-300">
                Founded {{ $category_count }} products of category: {{ $category_filter->plural_name}}
            </h2>
        </div>
        @endif
        @if ($brand_filter)
        <!-- If there was passed brand filter show brand name we are filtering -->
        <div class="w-full">
            <h2 class="text-sm px-4 uppercase font-semibold roboto text-gray-700 dark:text-gray-300">
                Founded {{ $brand_count }} products of brand: {{ $brand_filter->name}}
            </h2>
        </div>
        @endif

        <div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase">
                    <tr class="text-black dark:text-white">
                        <th scope="col" class="px-6 py-3">
                            <div class="flex cursor-pointer" wire:click="sortBy('id')">
                                <span class="uppercase">
                                    {{__('id')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="size-4 {{ $sortField === 'id' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex cursor-pointer" wire:click="sortBy('brand')">
                                <span class="uppercase">
                                    {{__('brand')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="size-4 {{ $sortField === 'brand' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex cursor-pointer" wire:click="sortBy('name')">
                                <span class="uppercase">
                                    {{__('name')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="size-4 {{ $sortField === 'name' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex cursor-pointer" wire:click="sortBy('suggested_retail_price')">
                                <span class="uppercase">
                                    {{__('SRP')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="size-4 {{ $sortField === 'suggested_retail_price' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
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
                        <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                            {{__('category')}}
                        </th>
                        <th scope="col" class="px-6 py-3 text-right">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700"
                        wire:key="row-{{ $product->id }}">
                        <td class="px-6 py-1 dark:text-gray-100 font-thin">
                            {{$product->id}}
                        </td>

                        <td scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex">
                                <a href="{{ route('brand.show', $product->brand->slug)}}" class="link my-auto" alt="{{$product->brand->name}}"
                                    label="{{$product->brand->name}}">{{Illuminate\Support\Str::limit($product->brand->name, 30, '...')}}</a>
                            </div>
                        </td>

                        <td scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex">
                                <a href="{{ route('product.show', [$product->brand, $product])}}" class="link my-auto" alt="{{$product->name}}"
                                    label="{{$product->name}}">{{Illuminate\Support\Str::limit($product->name, 30, '...')}}</a>
                            </div>
                        </td>

                        <td class="px-6 py-1 hidden lg:table-cell">
                            {{$product->formattedSRP()}}
                        </td>

                        <td class="px-6 py-1 hidden lg:table-cell">
                            {{$product->product_variants_count}}
                        </td>

                        <td class="px-6 py-1 hidden lg:table-cell">
                            {{$product->category->plural_name}}
                        </td>

                        <td class="px-6 py-1 flex justify-end">
                            <a href="{{route('product.edit', $product)}}" wire:navigate>
                                <x-buttons.edit-button >
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
            {{ $products->links() }}
        </div>
    </x-window>

</div>
