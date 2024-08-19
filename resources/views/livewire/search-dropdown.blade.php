<div>
    @if(!empty($searched))
    <x-input type="text" wire:model.debounce.500ms.live="search" class="w-full" placeholder="{{__('Search...')}}"/>

    <ul class="bg-white border mt-1 w-full rounded-lg z-10 max-h-32 overflow-y-auto p-2">
        @foreach ($searched as $searchItem)
        <li wire:click="selectItem({{$searchItem->id}})"
            class="cursor-pointer hover:bg-gray-200">
            {{ $searchItem?->{$searchBy} }}
        </li>
        @endforeach
    </ul>
    @endif
</div>
