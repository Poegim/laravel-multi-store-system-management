<div class="py-2 sm:py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="w-full flex justify-end my-4">
            <a href="{{route('store.create')}}">
                <x-button>
                    {{ __('CREATE') }}
                </x-button>
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{__('name')}}
                            </th>
                            <th scope="col" class="px-6 py-3 hidden md:table-cell">
                            {{__('email')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('action')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stores as $item)

                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <th scope="row"
                                class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex">
                                    <div style="background-color:{{$item->color->value}};" class="h-8 w-8 my-auto rounded-full"></div>
                                    <a href="{{route('store.show', $item)}}" class="my-auto ml-2" wire:navigate>{{$item->name}}</a>
                                </div>
                            </th>
                            <td class="px-6 py-2 hidden md:table-cell">
                                {{$item->email}}
                            </td>
                            <td class="px-6 py-2">

                                {{-- <x-buttons.edit-button wire:click="edit({{ $item->id }})">
                                    Edit
                                </x-buttons.edit-button> --}}

                                <a href="{{route('store.edit', $item)}}" wire:navigate>
                                    <x-buttons.edit-button class="edit-button" />
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>