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

                <input type="text" id="name" class="input-text" autofocus="false" wire:model.live="name" />

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

            <div>
                <x-search-multiselect-dropdown :collection="$devices" :inputName="'devices'"/>
            </div>

            {{-- <div class="text-sm p-4 rounded-mid  border border-gray-200 dark:border-gray-700 md:col-span-2" x-data="{  open: @entangle('modelsListVisibility'), search: @entangle('search') }" >
                <fieldset>
                    <legend class="mb-2 font-semibold text-sm text-gray-800 dark:text-gray-100">
                        {{ __('choose_devices') }}:
                    </legend>

                    <div class="pb-2 flex space-x-2 space-y-2 flex-wrap">
                    @if ($hiddenDevices)
                        @foreach ($hiddenDevices as $device)
                        <input type="hidden" name="hidden_devices[]" value="{{ $device }}" >
                        <div class="flex space-x-2">
                            <button
                            class="flex justify-end bg-red-100 text-red-800 text-sm font-medium pl-2 rounded-lg hover:bg-red-200 transition duration-200 ease-in-out dark:bg-gray-700 dark:text-red-400 border border-red-400" wire:click="handleDeviceSelect({{$device->id}})" type="button">
                            <div class="my-auto">
                                {{ $device->name }}
                            </div>
                            <div class="ml-2 bg-red-500 text-white font-bold p-2 rounded-r-lg hover:bg-red-600 transition duration-300 ease-in-out" style="line-height: 1;">
                                <svg fill="currentColor" class="size-3" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cancel</title> <path d="M10.771 8.518c-1.144 0.215-2.83 2.171-2.086 2.915l4.573 4.571-4.573 4.571c-0.915 0.915 1.829 3.656 2.744 2.742l4.573-4.571 4.573 4.571c0.915 0.915 3.658-1.829 2.744-2.742l-4.573-4.571 4.573-4.571c0.915-0.915-1.829-3.656-2.744-2.742l-4.573 4.571-4.573-4.571c-0.173-0.171-0.394-0.223-0.657-0.173v0zM16 1c-8.285 0-15 6.716-15 15s6.715 15 15 15 15-6.716 15-15-6.715-15-15-15zM16 4.75c6.213 0 11.25 5.037 11.25 11.25s-5.037 11.25-11.25 11.25-11.25-5.037-11.25-11.25c0.001-6.213 5.037-11.25 11.25-11.25z"></path> </g></svg>
                            </div>
                            </button>
                        </div>
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
                                <button class="flex gap-1" type="button" id="{{$device->id}}" name="devices[]" value="{{ $device->id }}" wire:click="handleDeviceSelect({{$device->id}})" >
                                    <svg class="size-3 my-auto" fill="currentColor" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" ><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>plus-circle</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-464.000000, -1087.000000)"> <path d="M480,1117 C472.268,1117 466,1110.73 466,1103 C466,1095.27 472.268,1089 480,1089 C487.732,1089 494,1095.27 494,1103 C494,1110.73 487.732,1117 480,1117 L480,1117 Z M480,1087 C471.163,1087 464,1094.16 464,1103 C464,1111.84 471.163,1119 480,1119 C488.837,1119 496,1111.84 496,1103 C496,1094.16 488.837,1087 480,1087 L480,1087 Z M486,1102 L481,1102 L481,1097 C481,1096.45 480.553,1096 480,1096 C479.447,1096 479,1096.45 479,1097 L479,1102 L474,1102 C473.447,1102 473,1102.45 473,1103 C473,1103.55 473.447,1104 474,1104 L479,1104 L479,1109 C479,1109.55 479.447,1110 480,1110 C480.553,1110 481,1109.55 481,1109 L481,1104 L486,1104 C486.553,1104 487,1103.55 487,1103 C487,1102.45 486.553,1102 486,1102 L486,1102 Z" id="plus-circle" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                                    {{ $device->name}}
                                </button>
                            </div>
                            
                            <div>
                                <button
                                class="flex justify-end bg-green-100 text-green-800 text-sm font-medium pl-2 rounded-lg hover:bg-green-200 transition duration-200 ease-in-out dark:bg-gray-700 dark:text-green-400 border border-green-400" wire:click="handleDeviceSelect({{$device->id}})" type="button">
                                    <div class="my-auto">
                                        {{$device->brand->name}} {{ $device->name }}
                                    </div>
                                    <div class="ml-2 bg-green-500 text-white font-bold p-2 rounded-r-lg hover:bg-green-600 transition duration-300 ease-in-out" style="line-height: 1;">
                                        <svg class="size-3" fill="currentColor" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" ><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>plus-circle</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-464.000000, -1087.000000)"> <path d="M480,1117 C472.268,1117 466,1110.73 466,1103 C466,1095.27 472.268,1089 480,1089 C487.732,1089 494,1095.27 494,1103 C494,1110.73 487.732,1117 480,1117 L480,1117 Z M480,1087 C471.163,1087 464,1094.16 464,1103 C464,1111.84 471.163,1119 480,1119 C488.837,1119 496,1111.84 496,1103 C496,1094.16 488.837,1087 480,1087 L480,1087 Z M486,1102 L481,1102 L481,1097 C481,1096.45 480.553,1096 480,1096 C479.447,1096 479,1096.45 479,1097 L479,1102 L474,1102 C473.447,1102 473,1102.45 473,1103 C473,1103.55 473.447,1104 474,1104 L479,1104 L479,1109 C479,1109.55 479.447,1110 480,1110 C480.553,1110 481,1109.55 481,1109 L481,1104 L486,1104 C486.553,1104 487,1103.55 487,1103 C487,1102.45 486.553,1102 486,1102 L486,1102 Z" id="plus-circle" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                                    </div>
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

            </div> --}}

        </div>

        <x-submit-cancel-btns :cancelRoute="'product-variant.index'" :type="'create'" />

    </form>
</x-window>
