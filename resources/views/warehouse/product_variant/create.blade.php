<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="top-header-breadcrumb-title">
                {{ __('create_product_variant') }}
            </div>
        </h2>
    </x-slot>

    {{-- @livewire('warehouse.product-variant.create-product-variant') --}}

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
    
            <div class="my-2 flex bg-gray-100 dark:bg-slate-900 p-2 rounded">
                <div class="mr-2 my-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-orange-500 dark:text-orange-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                </div>
                <div>
                    {{ __('In case of leaving the name field blank, a product variant name will be generated automatically.')}}
                </div>
                
            </div>  
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 py-2">
                <div class="p-4 rounded-mid border border-gray-200 dark:border-gray-700">
                    <label for="name" class="input-label" autofocus>{{ __('name') }}</label>
                    @error('name')
                    <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                    @enderror
                    <input type="text" name="name" class="input-text" autofocus="false" value="{{ old('name') ? old('name') : '' }}"/>
    

                    <label for="suggested_retail_price" class="input-label" >{{ __('suggested_retail_price') }}</label>
                    @error('suggested_retail_price')
                    <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                    @enderror
                    <input type="number" step="0.01" min="0.01" name="suggested_retail_price" value="{{ old('suggested_retail_price') ? old('suggested_retail_price') : '' }}" class="input-text" autofocus="false"/>
    
    
                    <label for="ean" class="input-label">{{ __('ean') }}</label>
                    @error('ean')
                    <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                    @enderror
    
                    <input type="text" id="ean" name="ean" class="input-text" autofocus="false" value="{{ old('ean') ? old('ean') : '' }}"/>
    
                    <label for="product_id" class="input-label">{{ __('product') }}</label>
                    @error('product_id')
                    <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                    @enderror
    
                    <x-search-dropdown :collection="$products" :inputName="'product_id'" :passedId="old('product_id') ?? null"></x-search-dropdown>
                </div>
    
                <div class="col-span-1 text-sm px-4 py-4 rounded-mid border border-gray-200 dark:border-gray-700">
                    <fieldset>
                        <legend class="font-semibold text-sm text-gray-800 dark:text-gray-100 -mb-1">
                            {{ __('choose_devices') }}:
                        </legend>
                        @error('devices')
                        <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                        @enderror
                        <x-search-multiselect-dropdown :collection="$devices" :inputName="'devices'" :passedIds="old('devices') ?? null"/>
                    </fieldset>
                </div>
    
                <div class="col-span-1 lg:col-span-2 text-sm p-4 rounded-mid border border-gray-200 dark:border-gray-700">
                    <fieldset>
                        <legend class="mb-2 font-semibold text-sm text-gray-800 dark:text-gray-100">
                            {{ __('choose_features') }}:</legend>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                            @foreach ($features as $feature)
                            <div>
                                <input type="checkbox" id="{{ $feature->id }}" name="features[]" value="{{ $feature->id }}" {{ in_array($feature->id, old('features', [])) ? 'checked' : '' }}/>
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

    

</x-app-layout>
