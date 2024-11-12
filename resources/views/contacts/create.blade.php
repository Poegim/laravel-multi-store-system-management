<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="sm:flex py-6 px-4">
            {{ __('Add new contact') }}
            </div>
        </h2>
    </x-slot>

    <x-window>
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="mt-4 p-4 rounded-mid  border border-gray-200 dark:border-gray-700 space-y-2" x-data="{type: 'person'}">


                <div>
                    <label for="contact_type" class="input-label">{{__('contact_type')}}</label>
                    @error('contact_type')
                    <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                    @enderror
                    <div class="flex space-x-2">
                        <span @click="type = 'person'" >
                            <input class="my-auto" type="radio" id="person" name="contact_type" value="1" />
                            <label for="person">{{__('person')}}</label>
                        </span>
                        <span  @click="type = 'company'">
                            <input class="my-auto" type="radio" id="company" name="contact_type" value="0" />
                            <label for="company">{{__('company')}}</label>
                        </span>
                    </div>
                </div>

                <div>
                    <label for="name" class="input-label">{{__('name')}}</label>
                    @error('name')
                    <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                    @enderror
                    <x-input type="text" name="name" id="name" class="w-full" />
                </div>

                <div>
                    @error('surname')
                    <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                    @enderror
                    <div :class="type == 'person' ? '' : 'hidden'">
                        <label for="surname" class="input-label">{{__('surname')}}</label>
                        <x-input type="text" name="surname" id="surname" class="w-full" />
                    </div>
                </div>

                <div>
                    <label for="identification_number" class="input-label">{{__('identification_number')}}</label>
                    @error('identification_number')
                    <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                    @enderror
                    <x-input type="text" name="identification_number" id="identification_number" class="w-full" />
                </div>

                <label for="contry" class="input-label">{{__('contry')}}</label>
                @error('contry')
                <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                @enderror
                <x-input type="text" name="contry" id="contry" class="w-full" value="Polska" />

                <label for="city" class="input-label">{{__('city')}}</label>
                @error('city')
                <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                @enderror
                <x-input type="text" name="city" id="city" class="w-full" />

                <label for="postcode" class="input-label">{{__('postcode')}}</label>
                @error('postcode')
                <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                @enderror
                <x-input type="text" name="postcode" id="postcode" class="w-full" />

                <label for="street" class="input-label">{{__('street')}}</label>
                @error('street')
                <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                @enderror
                <x-input type="text" name="street" id="street" class="w-full" />

                <label for="building_number" class="input-label">{{__('building_number')}}</label>
                @error('building_number')
                <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                @enderror
                <x-input type="text" name="building_number" id="building_number" class="w-full" />

                <label for="apartment_number" class="input-label">{{__('apartment_number')}}</label>
                @error('apartment_number')
                <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                @enderror
                <x-input type="text" name="apartment_number" id="apartment_number" class="w-full" />

                <label for="phone" class="input-label">{{__('phone')}}</label>
                @error('phone')
                <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                @enderror
                <x-input type="text" name="phone" id="phone" class="w-full" />

                <label for="second_phone" class="input-label">{{__('second_phone')}}</label>
                @error('second_phone')
                <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                @enderror
                <x-input type="text" name="second_phone" id="second_phone" class="w-full" />

                <label for="www" class="input-label">{{__('www')}}</label>
                @error('www')
                <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                @enderror
                <x-input type="text" name="www" id="www" class="w-full" />

                <label for="description" class="input-label">{{__('description')}}</label>
                @error('description')
                <div class="text-red-500 dark:text-red-300">{{ $message }}</div>
                @enderror
                <textarea class="rounded w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900" type="text" name="description" id="description" class="w-full" > </textarea>


            </div>


            <x-submit-cancel-btns :cancelRoute="'contact.index'" :type="'create'" />

        </form>
    </x-window>

</x-app-layout>
