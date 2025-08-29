<div>
    <!-- Create Button -->
    <div class="index-create-btn-div">
        <a href="{{ route('store.create') }}" wire:navigate>
            <x-button class="px-6 py-2 text-sm font-semibold rounded shadow-md bg-primary-600 text-white hover:bg-primary-700 transition">
                {{ __('Create Store') }}
            </x-button>
        </a>
    </div>

    <!-- Store List Window -->
    <x-window >

        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
            <thead>
                <tr class="border-b border-gray-200 dark:border-gray-700 uppercase text-xs text-gray-500 dark:text-gray-400">
                    <th class="px-2 sm:px-6 py-1 sm:py-3">{{ __('Name') }}</th>
                    <th class="px-2 sm:px-6 py-1 sm:py-3 hidden md:table-cell">{{ __('Phone') }}</th>
                    <th class="px-2 sm:px-6 py-1 sm:py-3 hidden md:table-cell">{{ __('Email') }}</th>
                    <th class="px-2 sm:px-6 py-1 sm:py-3 ">{{ __('Invoices Prefix') }}</th>
                    <th class="px-2 sm:px-6 py-1 sm:py-3 hidden lg:table-cell">{{ __('Address') }}</th>
                    <th class="px-2 sm:px-6 py-1 sm:py-3 text-center w-12"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($stores as $item)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <!-- Name with Color Circle -->
                    <td class="px-2 sm:px-6 py-1 sm:py-3 whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <div class="h-5 w-5 sm:h-8 sm:w-8 rounded-full" style="background-color: {{ $item->color->value }};"></div>
                            <a href="{{ route('store.show', $item) }}" class="font-medium hover:underline" wire:navigate>
                                {{ $item->name }}
                            </a>
                        </div>
                    </td>

                    <!-- Phone -->
                    <td class="px-2 sm:px-6 py-1 sm:py-3 hidden md:table-cell">
                        {{ $item->phone }}
                    </td>

                    <!-- Email -->
                    <td class="px-2 sm:px-6 py-1 sm:py-3 hidden md:table-cell">
                        {{ $item->email }}
                    </td>

                    <!-- Invoice Prefix -->
                    <td class="px-2 sm:px-6 py-1 sm:py-3">
                        {{ $item->invoices_prefix }}
                    </td>

                    <!-- Address -->
                    <td class="px-2 sm:px-6 py-1 sm:py-3 hidden lg:table-cell">
                        {{ $item->city }}, {{ $item->street }}, {{ $item->building_number }} {{ $item->apartment_number ? '/' . $item->apartment_number : '' }}
                    </td>

                    <!-- Edit Button -->
                    <td class="px-2 sm:px-6 py-1 sm:py-3 text-center">
                        <a href="{{ route('store.edit', $item) }}" wire:navigate>
                            <x-buttons.edit-button class="mx-auto" />
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </x-window>
</div>
