<div >

    <div class="index-create-btn-div">
        <x-input id="name" type="text" aria-placeholder="Search..." placeholder="Search..." wire:model.debounce.500ms.live="search" />
        <a href="{{ route('color.create')}}">
            <x-button>{{__('create')}}</x-button>
        </a>
    </div>

<x-window>
    <div class="overflow-x-auto">
        <table class="min-w-full text-xs text-left text-gray-700 dark:text-gray-300 border dark:border-gray-700 rounded overflow-hidden">
            <thead class="uppercase bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('id')">
                        ID
                    </th>
                    <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('name')">
                        {{ __('name') }}
                    </th>
                    <th class="px-4 py-2">{{ __('hex_value') }}</th>
                    <th class="px-4 py-2 hidden lg:table-cell">{{ __('created_by') }}</th>
                    <th class="px-4 py-2 hidden lg:table-cell">{{ __('created_at') }}</th>
                    <th class="px-4 py-2 hidden lg:table-cell">{{ __('updated_at') }}</th>
                    <th class="px-2 py-2 text-right">{{-- Actions --}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($colors as $color)
                <tr class="bg-white dark:bg-gray-800 border-t hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <td class="px-4 py-2">{{ $color->id }}</td>
                    <td class="px-4 py-2">{{ $color->name }}</td>
                    <td class="px-4 py-2">
                        <div class="flex items-center gap-2">
                            <div class="h-5 w-5 rounded-full border" style="background-color: {{ $color->value }};"></div>
                            <span>{{ $color->value }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-2 hidden lg:table-cell">
                        <div class="flex items-center gap-2">
                            <img src="{{ $color->user->profile_photo_url }}" alt="{{ $color->user->name }}" class="rounded-full w-6 h-6 object-cover">
                            <span>{{ $color->user->name }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-2 hidden lg:table-cell">{{ $color->created_at }}</td>
                    <td class="px-4 py-2 hidden lg:table-cell">{{ $color->updated_at }}</td>
                    <td class="px-2 py-2 text-right">
                        <a href="{{ route('color.edit', $color) }}">
                            <x-buttons.edit-button>{{ __('edit') }}</x-buttons.edit-button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="m-4">
        {{ $colors->links(data: ['scrollTo' => false]) }}
    </div>
</x-window>

</div>
