<div>
    
    <x-button wire:click="showModal('create')">
        {{ __('CREATE') }}
    </x-button>

    <!-- Show Create Modal -->
    <x-dialog-modal wire:model.live="modalVisibility">
        <x-slot name="title">
            {{ __('Create Brand') }}
        </x-slot>

        <x-slot name="content">

            @if ($errors->any())
            <x-lists.errors-list>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </x-lists.errors-list>
            @endif

            <div class="mt-4 p-4 rounded-lg border border-gray-200 dark:border-gray-700">

                <label for="name"
                    class="input-label">{{__('name')}}</label>
                @error('name')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                <input wire:model.live="name" type="text" id="name"
                    class="input-text"
                    required value="{{$name}}" />

                <label for="slug" class="input-label">{{__('slug')}}</label>
                @error('slug')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror
                <input wire:model="slug" type="text" id="slug"
                class="input-text"
                required value="{{$slug}}" disabled/>
                
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalVisibility')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-danger-button class="ms-3" wire:click="store()">
                {{ __('Create') }}
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>
</div>
