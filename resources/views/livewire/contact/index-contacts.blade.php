<div >

    <div class="index-create-btn-div">
        <x-input id="name" type="text" aria-placeholder="Search..." placeholder="Search..." wire:model.debounce.500ms.live="search" />
        <a href="{{route('contact.create')}}" wire:navigate>
            <x-button>
                {{ __('CREATE') }}
            </x-button>
        </a>
    </div>

    <x-window>
        <div class="overflow-x-auto">
            <table class="rounded-2xl overflow-hidden min-w-full text-xs text-left text-gray-700 dark:text-gray-300 border dark:border-gray-700">
                <thead class="uppercase bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                    <tr>
                        <th scope="col" class="px-4 py-2">
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
                        <th scope="col" class="px-4 py-2">
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
                        <th scope="col" class="px-4 py-2">
                            <div class="flex cursor-pointer">
                                <span class="uppercase">
                                    {{__('identification number')}}
                                </span>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-2 hidden lg:table-cell">
                            <div class="flex cursor-pointer">
                                <span class="uppercase">
                                    {{__('type')}}
                                </span>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-2 hidden lg:table-cell">
                            <div class="flex cursor-pointer">
                                <span class="uppercase">
                                    {{__('email')}}
                                </span>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-2 hidden lg:table-cell">
                            <div class="flex cursor-pointer">
                                <span class="uppercase">
                                    {{__('phone')}}
                                </span>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-2 text-right">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr class="bg-white dark:bg-gray-800 border-t hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                        wire:key="row-{{ $contact->id }}">
                        <td class="px-4 py-2 dark:text-gray-100 font-thin">
                            {{$contact->id}}
                        </td>

                        <td scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex">
                                <a href="{{ route('contact.show', $contact) }}" class="link my-auto" alt="{{$contact->name}}"
                                    label="{{$contact->name}}">{{Illuminate\Support\Str::limit($contact->name, 30, '...')}}</a>
                            </div>
                        </td>

                        <td scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $contact->identification_number}}
                        </td>

                        <td class="px-4 py-2 hidden lg:table-cell">
                            {{$contact->type()}}
                        </td>

                        <td class="px-4 py-2 hidden lg:table-cell">
                            {{$contact->email}}
                        </td>

                        <td class="px-4 py-2 hidden lg:table-cell">
                            {{$contact->phone}}
                        </td>

                        <td class="px-4 py-2 flex justify-end">
                            <a href="{{route('contact.edit', $contact)}}" wire:navigate>
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
            {{ $contacts->links(data: ['scrollTo' => false]) }}
        </div>
    </x-window>

</div>
