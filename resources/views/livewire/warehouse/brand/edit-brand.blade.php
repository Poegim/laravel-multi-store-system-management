<div>
    
    <x-buttons.edit-button wire:click="showModal('edit')">
        Edit
    </x-buttons.edit-button>

    <!-- Show Create Modal -->
    <x-dialog-modal wire:model.live="modalVisibility">
        <x-slot name="title">
            {{ __('Edit') }}: {{$brand->name}}
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
                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('name')}}</label>
                @error('name')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                <input wire:model.live="name" type="text" id="name"
                    class="mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required value="{{$name}}" />

                <label for="slug" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('slug')}}</label>
                @error('slug')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror
                <input wire:model="slug" type="text" id="slug"
                class="mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                required value="{{$slug}}" disabled/>
                
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalVisibility')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-danger-button class="ms-3" wire:click="update()">
                {{ __('Update') }}
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>
</div>
