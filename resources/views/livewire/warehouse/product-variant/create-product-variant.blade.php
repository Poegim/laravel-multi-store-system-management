<div x-cloak 
    x-data="{ visibleList: false, search: '', open: false, }"
    >

    <x-button wire:click="showModal('create')" x-on:click="open = ! open">
        {{ __('CREATE') }}
    </x-button>

    <!-- Show Create Modal -->
    <div class="w-full bg-white dark:bg-slate-900 z-50 h-full top-0 left-0 fixed p-1 sm:p-8 lg:p-12 space-y-4" :class="open ? '' : 'hidden'">

        <div class="font-semibold">
            {{ __('Create Product Variant') }}
        </div>

        <div name="content" class="bg-gray-50 dark:bg-slate-800 rounded">

            @if ($errors->any())
            <x-lists.errors-list>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </x-lists.errors-list>
            @endif

            <div class="mt-4 p-4 rounded-mid  border border-gray-200 dark:border-gray-700">

                <label for="name"
                    class="input-label" autofocus>{{__('name')}}</label>
                @error('name')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                <input wire:model.live="name" type="text" id="name"
                    class="input-text"
                    required 
                    autofocus="false"/>


                <label for="slug" class="input-label">{{__('slug')}}</label>
                @error('slug')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror
                <input wire:model="slug" type="text" id="slug"
                class="input-text"
                required disabled/>

                <label for="ean"
                class="input-label" >{{__('ean')}}</label>
                @error('ean')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                <input wire:model="ean" type="text" id="ean"
                    class="input-text"
                    required 
                    autofocus="false"/>

                <label for="product_id"
                class="input-label" >{{__('product')}}</label>
                @error('product_id')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror
                <livewire:search-dropdown :collection="$products" wire:model="product_id" />

            </div>

        </div>

        <div name="footer">

            <x-secondary-button wire:click="resetVars" x-on:click="open = ! open">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="store()">
                {{ __('Create') }}
            </x-danger-button>  

        </div>

    </div>

</div>
