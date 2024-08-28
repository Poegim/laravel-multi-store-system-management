<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight lowercase">
            <div class="sm:flex">
                <a class="link" href="{{route('store.index')}}" wire:navigate>{{__('back to:')}} {{ __('stores') }}</a>
                <div class="flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="hidden sm:block size-5 my-auto -rotate-90">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    {{__('create store')}}
                </div>
            </div>
        </h2>
    </x-slot>

    <div class="py-2 sm:py-4 dark:text-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <div class="m-4 rounded-lg" class="rounded-lg overflow-hidden">

                        <form action="{{ route('store.store') }}" method="POST">
                            @csrf

                            @if ($errors->any())
                            <x-lists.errors-list>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </x-lists.errors-list>
                            @endif

                            <div x-data="{ open: true}"
                                class="border border-gray-200 dark:border-gray-600 rounded-lg my-2 overflow-hidden">
                                <button type="button" class="accordion-btn" x-on:click="open = !open"
                                    :class="!open ? '' : 'bg-gray-200 dark:bg-gray-900'">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="size-5 my-auto transition-transform duration-75"
                                        :class="!open ? '' : 'rotate-180'">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                    <span class="ml-1">
                                        {{__('basic')}}
                                    </span>
                                </button>

                                <!-- Basic tab -->
                                <div class="p-4" x-show="open">

                                    <label for="name"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('name')}}</label>
                                    @error('name')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="text" id="name" name="name"
                                        class="mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{ old('name') ? old('name') : ''}}" />

                                    <label for="order"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{ __('order')}}</label>
                                    @error('order')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="number" id="order" name="order"
                                        class="mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('order') ? old('order') : 0 }}" />

                                    <label for="color_id" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{ __('select color')}}:</label>
                                    @error('color_id')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror

                                    <select id="color_id" name="color_id"
                                    class="mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value=""></option>
                                    @foreach ($colors as $color)
                                    <option style="background-color: {{$color->value}} ;"
                                    value="{{$color->id}}" @if(old('color_id') == $color->id) selected @endif>{{ $color->name }}</option>
                                    @endforeach
                                    </select>

                                    <label for="email"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('email')}}</label>
                                    @error('email')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="email" id="email" name="email"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{ old('email') ? old('email') : ''}}" />

                                    <label for="phone"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('phone')}}</label>
                                    @error('phone')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="text" id="phone" name="phone"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('phone') ? old('phone') : null }}" />

                                </div>
                            </div>
                            
                            <!-- Address tab -->
                            <div x-data="{ open: true}"
                                class="border border-gray-200 dark:border-gray-600 rounded-lg my-2 overflow-hidden">
                                <button type="button" class="accordion-btn" x-on:click="open = !open"
                                    :class="!open ? '' : 'bg-gray-200 dark:bg-gray-900'">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="size-5 my-auto transition-transform duration-75"
                                        :class="!open ? '' : 'rotate-180'">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                    <span class="ml-1">
                                        {{__('address')}}
                                    </span>
                                </button>

                                <!-- Address tab -->
                                <div class="p-4" x-show="open">
                                    <label for="city"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('city')}}</label>
                                    @error('city')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="text" id="city"  name="city"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('city') ? old('city') : ''}}" />

                                    <label for="postcode"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('postcode')}}</label>
                                    @error('postcode')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="text" id="postcode" name="postcode"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('postcode') ? old('postcode') : null}}" />

                                    <label for="street"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('street')}}</label>
                                    @error('street')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="text" id="street" name="street"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('street') ? old('street') : ''}}" />

                                    <label for="building_number"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('building_number')}}</label>
                                    @error('building_number')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="text" id="building_number" name="building_number"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('building_number') ? old('building_number') : ''}}" />

                                    <label for="apartment_number"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('apartment_number')}}</label>
                                    @error('apartment_number')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="text" id="apartment_number" name="apartment_number"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('apartment_number') ? old('apartment_number') : ''}}" />
                                </div>
                            </div>

                            <!-- Prefixes tab -->
                            <div x-data="{ open: true}"
                                class="border border-gray-200 dark:border-gray-600 rounded-lg my-2 overflow-hidden">
                                <button type="button" class="accordion-btn" x-on:click="open = !open"
                                    :class="!open ? '' : 'bg-gray-200 dark:bg-gray-900'">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="size-5 my-auto transition-transform duration-75"
                                        :class="!open ? '' : 'rotate-180'">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                    <span class="ml-1">
                                        {{__('prefixes')}}
                                    </span>
                                </button>

                                <!-- Prefixes tab -->
                                <div class="p-4" x-show="open">
                                    <label for="contracts_prefix"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('contracts_prefix')}}</label>
                                    @error('contracts_prefix')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="text" id="contracts_prefix" name="contracts_prefix"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('contracts_prefix') ? old('contracts_prefix') : ''}}" />

                                    <label for="invoices_prefix"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('invoices_prefix')}}</label>
                                    @error('invoices_prefix')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="text" id="invoices_prefix" name="invoices_prefix"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('invoices_prefix') ? old('invoices_prefix') : ''}}" />

                                    <label for="margin_invoices_prefix"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('margin_invoices_prefix')}}</label>
                                    @error('margin_invoices_prefix')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="text" id="margin_invoices_prefix" name="margin_invoices_prefix"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('margin_invoices_prefix') ? old('margin_invoices_prefix') : ''}}" />

                                    <label for="proforma_invoices_prefix"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('proforma_invoices_prefix')}}</label>
                                    @error('proforma_invoices_prefix')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="text" id="proforma_invoices_prefix" name="proforma_invoices_prefix"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('proforma_invoices_prefix') ? old('proforma_invoices_prefix') : ''}}" />

                                    <label for="internal_servicing_prefix"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('internal_servicing_prefix')}}</label>
                                    @error('internal_servicing_prefix')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="text" id="internal_servicing_prefix" name="internal_servicing_prefix"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('internal_servicing_prefix') ? old('internal_servicing_prefix') : ''}}" />

                                    <label for="external_servicing_prefix"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('external_servicing_prefix')}}</label>
                                    @error('external_servicing_prefix')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="text" id="external_servicing_prefix" name="external_servicing_prefix"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('external_servicing_prefix') ? old('external_servicing_prefix') : ''}}" />
                                </div>
                            </div>

                            <!-- Indexes tab -->
                            <div x-data="{ open: true}"
                                class="border border-gray-200 dark:border-gray-600 rounded-lg my-2 overflow-hidden">
                                <button type="button" class="accordion-btn" x-on:click="open = !open"
                                    :class="!open ? '' : 'bg-gray-200 dark:bg-gray-900'">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="size-5 my-auto transition-transform duration-75"
                                        :class="!open ? '' : 'rotate-180'">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                    <span class="ml-1">
                                        {{__('indexes')}}
                                    </span>
                                </button>

                                <!-- Indexes tab -->
                                <div class="p-4" x-show="open">
                                    <label for="next_receipt_number"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('next_receipt_number')}}</label>
                                    @error('next_receipt_number')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="number" id="next_receipt_number" name="next_receipt_number"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('next_receipt_number') ? old('next_receipt_number') : null}}" />

                                    <label for="next_invoice_number"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('next_invoice_number')}}</label>
                                    @error('next_invoice_number')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="number" id="next_invoice_number" name="next_invoice_number"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('next_invoice_number') ? old('next_invoice_number') : null}}" />

                                    <label for="next_margin_invoice_number"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('next_margin_invoice_number')}}</label>
                                    @error('next_margin_invoice_number')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="number" id="next_margin_invoice_number" name="next_margin_invoice_number"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('next_margin_invoice_number') ? old('next_margin_invoice_number') : null}}" />

                                    <label for="next_proforma_invoice_number"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('next_proforma_invoice_number')}}</label>
                                    @error('next_proforma_invoice_number')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="number" id="next_proforma_invoice_number" name="next_proforma_invoice_number"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('next_proforma_invoice_number') ? old('next_proforma_invoice_number') : null}}" />

                                    <label for="next_internal_servicing_number"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('next_internal_servicing_number')}}</label>
                                    @error('next_internal_servicing_number')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="number" id="next_internal_servicing_number" name="next_internal_servicing_number"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('next_internal_servicing_number') ? old('next_internal_servicing_number') : null}}" />

                                    <label for="next_external_servicing_number"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('next_external_servicing_number')}}</label>
                                    @error('next_external_servicing_number')
                                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                    @enderror
                                    <input type="number" id="next_external_servicing_number" name="next_external_servicing_number"
                                        class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required value="{{old('next_external_servicing_number') ? old('next_external_servicing_number') : null}}" />
                                </div>
                            </div>

                            <!-- Description tab -->
                            <div x-data="{ open: true}"
                            class="border border-gray-200 dark:border-gray-600 rounded-lg my-2 overflow-hidden">
                            <button type="button" class="accordion-btn" x-on:click="open = !open"
                                :class="!open ? '' : 'bg-gray-200 dark:bg-gray-900'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="size-5 my-auto transition-transform duration-75"
                                    :class="!open ? '' : 'rotate-180'">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                                <span class="ml-1">
                                    {{__('description')}}
                                </span>
                            </button>

                            <!-- Description tab -->
                            <div class="p-4" x-show="open">
                                <label for="description"
                                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{__('description')}}</label>
                                @error('description')
                                <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                                @enderror
                                <textarea id="description" name="description"
                                    class=" mb-4 border border-indigo-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required value="{{old('description') ? old('description') : ''}}" >
                                </textarea>

                            </div>
                        </div>

                            <div class="flex justify-end space-x-2 mt-4">
                                <a href="{{route('store.index')}}">
                                    <x-secondary-button>Cancel</x-secondary-button>
                                </a>
                                <x-danger-button type="submit">Create</x-danger-button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
