<div>
    <x-window>
        @error('searchItem')
        <div class="mb-2 bg-red-900 text-white tex-sm p-1 px-2 w-full rounded-lg flex items-center">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        {{ $message }}
        </div>
        @enderror
        <div class="flex items-center gap-2">
            <input class="border border-gray-300 p-1 rounded-lg text-sm" type="text" placeholder="{{ __('Search for a item') }}" wire:model="searchItem" />
            <button class="bg-blue-500 text-white text-sm p-1 px-2 rounded-lg" wire:click="addItem">Add</button>
        </div>
    </x-window>
</div>
