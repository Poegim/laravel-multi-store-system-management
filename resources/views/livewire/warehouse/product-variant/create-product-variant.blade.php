<x-window>
    <form action="{{ route('product-variant.store') }}" method="POST">
        @csrf

        @if ($errors->any())
        <x-lists.errors-list>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </x-lists.errors-list>
        @endif

        <div class="grid md:grid-cols-2 gap-4 py-2">

            <div class="p-4 rounded-mid  border border-gray-200 dark:border-gray-700">

                <label for="name" class="input-label" autofocus>{{__('name')}}</label>
                @error('name')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                <input type="text" id="name" class="input-text" autofocus="false" />

                <label for="ean" class="input-label">{{__('ean')}}</label>
                @error('slug')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                @error('ean')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                <input type="text" id="ean" class="input-text" autofocus="false" />

                <label for="product_id" class="input-label">{{__('product')}}</label>
                @error('product_id')
                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                @enderror

                <x-search-dropdown :collection="$products" :inputName="'product_id'" />

            </div>

            <div class=" text-sm p-4 rounded-mid  border border-gray-200 dark:border-gray-700">
                <fieldset class="">
                    <legend class="mb-2 font-semibold text-sm text-gray-800 dark:text-gray-100">
                        {{ __('choose_features') }}:</legend>
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($features as $feature)
                        <div>
                            <input type="checkbox" id="{{$feature->id}}" name="features[]" value="{{ $feature->id }}" />
                            <label class="text-gray-700 dark:text-gray-300"
                                for="{{$feature->id}}">{{ $feature->name}}</label>
                        </div>
                        @endforeach
                    </div>
                </fieldset>
            </div>

            <div class="text-sm p-4 rounded-mid  border border-gray-200 dark:border-gray-700 md:col-span-2" x-data="{  open: @entangle('modelsListVisibility'), search: @entangle('search') }" >
                <fieldset>
                    <legend class="mb-2 font-semibold text-sm text-gray-800 dark:text-gray-100">
                        {{ __('choose_devices') }}:
                    </legend>

                    <div class="pb-2">
                    @if ($hiddenDevices)
                        @foreach ($hiddenDevices as $device)
                        <input type="hidden" name="hidden_devices[]" value="{{ $device }}">
                        <button type="button" wire:click="handleDeviceSelect({{$device->id}})" class="inline-flex items-center bg-red-100 text-red-800 text-sm font-medium px-3 py-1 rounded-full hover:bg-red-200 transition duration-300 ease-in-out dark:bg-gray-700 dark:text-red-400 border border-red-400">
                            <span class="flex items-center">
                                {{$device->name}}
                                <span class="ml-2 bg-red-500 text-white font-bold px-2 py-0.5 rounded-full hover:bg-red-600 transition duration-300 ease-in-out">
                                    X
                                </span>
                            </span>
                        </button>
                        @endforeach
                    @endif
                    </div>

                    <div class="pb-2 flex">
                        <x-input id="name" class="w-full" type="text" aria-placeholder="Search model..." placeholder="Search model..." wire:model.live.debounce.500ms="search" />
                    </div>

                    @if ($devices->count() > 0)
                        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-1 h-[300px] overflow-y-auto" >
                            @foreach ($devices as $device)
                            <div>
                                <button class="inline-flex items-center bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full hover:bg-green-200 transition duration-300 ease-in-out dark:bg-gray-700 dark:text-green-400 border border-green-400" wire:click="handleDeviceSelect({{$device->id}})" type="button">
                                    <span class="flex items-center">
                                        {{ $device->name }}
                                        <span class="ml-2 bg-green-500 text-white font-bold px-2 py-0.5 rounded-full hover:bg-green-600 transition duration-300 ease-in-out" style="line-height: 1;">
                                            +
                                        </span>
                                    </span>
                                </button>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            {{ __('No devices found!') }}
                        </div>
                    @endif
                </fieldset>

            </div>

        </div>

        <x-submit-cancel-btns :cancelRoute="'product-variant.index'" :type="'create'" />

    </form>
</x-window>
