<div >

        <div class="w-full flex justify-end my-1 sm:my-4 h-9 space-x-2 pr-2 sm:pr-0">
            <x-input id="name" type="text" aria-placeholder="Search..." placeholder="Search..." wire:model.debounce.500ms.live="search" />
            <a href="{{ route('feature.create')}}">
                <x-button>{{__('create')}}</x-button>
            </a>
        </div>

        <x-window>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs uppercase">
                        <tr class="text-black dark:text-white">
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
                            {{__('short name')}}
                            </th>

                            <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                            {{__('stock_count')}}
                            </th>

                            <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                            {{__('slug')}}
                            </th>
                            <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                            {{__('created_by')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($features as $feature)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <th scope="row"
                                class="font-thin px-6 py-1 text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$feature->id}}
                            </th>
                            <th scope="row"
                                class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex">
                                    <a href="{{ route('feature.show', $feature->slug) }}" class="link my-auto">{{$feature->name}}</a>
                                </div>
                            </th>
                            <td class="px-6 py-1 hidden lg:table-cell">
                                {{$feature->short_name}}
                            </td>
                            <td class="px-6 py-1 hidden lg:table-cell">
                                {{ $feature->totalStockItemsCount() }}
                            </td>
                            <td class="px-6 py-1 hidden lg:table-cell">
                                {{$feature->slug}}
                            </td>
                            <td class="px-6 py-1 hidden lg:table-cell">
                                <div class="flex">
                                    <img src="{{ $feature->user->profile_photo_url }}" alt="{{ $feature->user->name }}"
                                    class="rounded-full w-12 h-12 md:h-8 md:w-8 object-cover mr-2 my-auto mb-4 md:mb-0">
                                    <div class="my-auto">
                                        {{$feature->user->name}}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-1 flex justify-end">
                                <a href="{{route('feature.edit', $feature->slug)}}">
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
                {{ $features->links() }}
            </div>
        </x-window>
</div>
