<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight lowercase">
            <div class="sm:flex">
                <a class="link" href="{{ route('product.index')}} " wire:navigate>{{__('back to:')}}
                    {{ __('products') }}</a>
                <div class="flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="hidden sm:block size-5 my-auto -rotate-90">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    {{__('create product')}}
                </div>
            </div>
        </h2>
    </x-slot>

    <form action="{{ route('product.store') }}" method="POST">
    @csrf

    <x-window>

        @if ($errors->any())
        <x-lists.errors-list>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </x-lists.errors-list>
        @endif

        <div class="mt-4 p-4 rounded-lg border border-gray-200 dark:border-gray-700">

            <label for="name" class="input-label">{{__('name')}}</label>
            @error('name')
            <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
            @enderror

            <input name="name" 
                type="text" 
                id="name" 
                class="input-text"
                required value="{{ old('name') ? old('name') : ''}}" />

            <label for="category" class="input-label">{{__('category')}}</label>
            @error('category')
            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
            @enderror
            <select class="w-full rounded-lg border border-blue-300 mb-4" name="category_id">
                {!! $categoryOptions !!}
            </select>

            <label for="brand_id" class="input-label">{{__('brand_id')}}
            </label>
            @error('brand_id')
            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
            @enderror

            <x-search-dropdown :collection="$brands" :inputName="'brand_id'" :passedId="old('brand_id') ?? null" :searchBy="'name'" />


            @error('is_device')
            <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
            @enderror
            
            <label for="is_device" class="mt-4 input-label">{{__('is_device')}}</label>

            <div class="flex space-x-2">
            <input class="my-auto" type="radio" id="html" name="is_device" value="1" {{ old('is_device') == 1 ? 'checked' : 'unchecked' }} >
            <x-label for="html">{{__('yes')}}</x-label>
            <input class="my-auto" type="radio" id="css" name="is_device" value="0" {{ old('is_device') != 1 ? 'checked' : 'unchecked' }}/>
            <x-label for="css">{{__('no')}}</x-label>
            </div>

        </div>

        <x-submit-cancel-btns :cancelRoute="'product.index'" :type="'create'" />

    </x-window>
    </form>

</x-app-layout>
