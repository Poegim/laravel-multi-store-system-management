<div >

    <div class="w-full flex justify-end my-1 sm:my-4 h-9 space-x-2 pr-2 sm:pr-0">
        <x-input id="name" type="text" aria-placeholder="Search..." placeholder="Search..." wire:model.debounce.500ms.live="search" />
        <a href="{{route('contact.create')}}" wire:navigate>
            <x-button>
                {{ __('CREATE') }}
            </x-button>
        </a>
    </div>

    <x-window>

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
                            <div class="flex cursor-pointer" wire:click="sortBy('surname')">
                                <span class="uppercase">
                                    {{__('surname')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="size-4 {{ $sortField === 'surname' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex cursor-pointer">
                                <span class="uppercase">
                                    {{__('identification_number')}}
                                </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex cursor-pointer">
                                <span class="uppercase">
                                    {{__('type')}}
                                </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex cursor-pointer">
                                <span class="uppercase">
                                    {{__('email')}}
                                </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex cursor-pointer">
                                <span class="uppercase">
                                    {{__('phone')}}
                                </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-right">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700"
                        wire:key="row-{{ $contact->id }}">
                        <td class="px-6 py-1 dark:text-gray-100 font-thin">
                            {{$contact->id}}
                        </td>

                        <td scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex">
                                <a href="{{ route('contact.show', $contact) }}" class="link my-auto" alt="{{$contact->name}}"
                                    label="{{$contact->name}}">{{Illuminate\Support\Str::limit($contact->name, 30, '...')}}</a>
                            </div>
                        </td>
                        <td scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex">
                                <a href="{{ route('contact.show', $contact) }}" class="link my-auto" alt="{{$contact->surname}}"
                                    label="{{$contact->surname}}">{{Illuminate\Support\Str::limit($contact->surname, 30, '...')}}</a>
                            </div>
                        </td>

                        <td scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $contact->identification_number}}
                        </td>

                        <td class="px-6 py-1 hidden lg:table-cell">
                            {{$contact->type()}}
                        </td>

                        <td class="px-6 py-1 hidden lg:table-cell">
                            {{$contact->email}}
                        </td>

                        <td class="px-6 py-1 hidden lg:table-cell">
                            {{$contact->phone}}
                        </td>

                        <td class="px-6 py-1 flex justify-end">
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
            {{ $contacts    ->links() }}
        </div>
    </x-window>

</div>
