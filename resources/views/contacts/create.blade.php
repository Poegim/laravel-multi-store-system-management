<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="sm:flex py-6 px-4">
            {{ __('Add new contact') }}
            </div>
        </h2>
    </x-slot>

    <x-window>

        @if ($errors->any())
        <x-lists.errors-list>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </x-lists.errors-list>
        @endif


        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="mt-4 p-4 rounded-mid  border border-gray-200 dark:border-gray-700 space-y-2 grid md:grid-cols-2 gap-x-4" x-data="{type: 'person'}">


                <div class="md:col-span-2">
                    <label for="type" class="input-label">{{__('type')}}</label>
                    <div class="flex space-x-2">
                        <span @click="type = 'person'" >
                            <input class="my-auto" type="radio" id="person" name="type" value="1" />
                            <label for="person">{{__('person')}}</label>
                        </span>
                        <span  @click="type = 'company'">
                            <input class="my-auto" type="radio" id="company" name="type" value="2" />
                            <label for="company">{{__('company')}}</label>
                        </span>
                    </div>
                </div>


                <div>
                    <label for="name" class="input-label">{{__('name')}}</label>
                    <x-input type="text" name="name" id="name" class="w-full" required />
                </div>

                <div>
                    <div :class="type == 'person' ? '' : 'hidden'">
                        <label for="surname" class="input-label">{{__('surname')}}</label>
                        <x-input type="text" name="surname" id="surname" class="w-full" />
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label for="identification_number" class="input-label">{{__('identification_number')}}</label>
                    <x-input type="text" name="identification_number" id="identification_number" class="w-full md:w-1/2" />
                </div>

                <div>
                    <label for="contry" class="input-label">{{__('contry')}}</label>
                    <x-input type="text" name="contry" id="contry" class="w-full" value="Polska" />
                </div>

                <div>
                    <label for="city" class="input-label">{{__('city')}}</label>
                    <x-input type="text" name="city" id="city" class="w-full" />
                </div>
                <div>
                    <label for="postcode" class="input-label">{{__('postcode')}}</label>
                    <x-input type="text" name="postcode" id="postcode" class="w-full" />
                </div>

                <div>
                    <label for="street" class="input-label">{{__('street')}}</label>
                    <x-input type="text" name="street" id="street" class="w-full" />
                </div>

                <div>
                    <label for="building_number" class="input-label">{{__('building_number')}}</label>
                    <x-input type="text" name="building_number" id="building_number" class="w-full" />
                </div>

                <div>
                    <label for="apartment_number" class="input-label">{{__('apartment_number')}}</label>
                    <x-input type="text" name="apartment_number" id="apartment_number" class="w-full" />
                </div>

                <div>
                    <label for="email" class="input-label">{{__('email')}}</label>
                    <x-input type="email" name="email" id="email" class="w-full" />
                </div>

                <div>
                    <label for="phone" class="input-label">{{__('phone')}}</label>
                    <x-input type="text" name="phone" id="phone" class="w-full" />
                </div>

                <div>
                    <label for="second_phone" class="input-label">{{__('second_phone')}}</label>
                    <x-input type="text" name="second_phone" id="second_phone" class="w-full" />
                </div>

                <div>
                    <label for="www" class="input-label">{{__('www')}}</label>
                   <x-input type="text" name="www" id="www" class="w-full" />
                </div>    

                <div class="md:col-span-2">
                    <label for="description" class="input-label">{{__('description')}}</label>
                    <textarea class="rounded w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900" type="text" name="description" id="description" class="w-full" > </textarea>
                </div>


            </div>


            <x-submit-cancel-btns :cancelRoute="'contact.index'" :type="'create'" />

        </form>
    </x-window>

</x-app-layout>
