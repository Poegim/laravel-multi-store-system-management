<div class="py-12">
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
                                {{__('name')}}
                            </th>
                            <th scope="col" class="px-6 py-3 hidden md:table-cell">
                            {{__('slug')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right">
                                {{__('action')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $item)

                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <th scope="row"
                                class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex">
                                    <a href="#" class="my-auto">{{$item->name}}</a>
                                </div>
                            </th>
                            <td class="px-6 py-2 hidden md:table-cell">
                                {{$item->slug}}
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
                {{ $brands->links() }}
            </div>            
        </div>

    </div>    
</div>
