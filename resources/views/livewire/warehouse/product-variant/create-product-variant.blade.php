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

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 py-2">
            <div class="p-4 rounded-mid border border-gray-200 dark:border-gray-700">
                <label for="name" class="input-label" autofocus>{{ __('name') }}</label>
                @error('name')
                <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                @enderror

                <input type="text" name="name" class="input-text" autofocus="false"/>

                <label for="ean" class="input-label">{{ __('ean') }}</label>
                @error('ean')
                <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                @enderror

                <input type="text" id="ean" name="ean" class="input-text" autofocus="false" />

                <label for="product_id" class="input-label">{{ __('product') }}</label>
                @error('product_id')
                <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                @enderror

                <x-search-dropdown :collection="$products" :inputName="'product_id'"></x-search-dropdown>
            </div>

            <div class="col-span-1 text-sm px-4 py-4 rounded-mid border border-gray-200 dark:border-gray-700">
                <fieldset>
                    <legend class="font-semibold text-sm text-gray-800 dark:text-gray-100 -mb-1">
                        {{ __('choose_devices') }}:
                    </legend>
                    <x-search-multiselect-dropdown :collection="$devices" :inputName="'devices'" />
                </fieldset>
            </div>

            <div class="col-span-1 lg:col-span-2 text-sm p-4 rounded-mid border border-gray-200 dark:border-gray-700">
                <fieldset>
                    <legend class="mb-2 font-semibold text-sm text-gray-800 dark:text-gray-100">
                        {{ __('choose_features') }}:</legend>
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($features as $feature)
                        <div>
                            <input type="checkbox" id="{{ $feature->id }}" name="features[]" value="{{ $feature->id }}" />
                            <label class="text-gray-700 dark:text-gray-300" for="{{ $feature->id }}">{{ $feature->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </fieldset>
            </div>
        </div>

        <x-submit-cancel-btns :cancelRoute="'product-variant.index'" :type="'create'" />

    </form>
</x-window>
