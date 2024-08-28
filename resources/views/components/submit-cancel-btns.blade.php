<div class="mt-4 w-full flex justify-end space-x-2">
    <a href="{{route($cancelRoute)}}" wire:navigate>
        <x-secondary-button type="button">
            {{ __('Cancel') }}
        </x-secondary-button>
    </a>
    <x-danger-button type="submit">
        {{ __($type) }}
    </x-danger-button>
</div>