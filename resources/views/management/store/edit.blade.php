<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight lowercase">
            <div class="sm:flex py-6 px-4">
                <a class="link" href="{{route('store.index')}}" wire:navigate>{{__('back to:')}} {{ __('stores') }}</a>
                <div class="flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="hidden sm:block size-5 my-auto -rotate-90">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    {{__('edit: ')}} {{ $store->name }}
                </div>
            </div>
        </h2>
    </x-slot>

    <x-window>

        <form action="{{ route('store.update', $store) }}" method="POST">
            @csrf
            @method('PUT')

            @if ($errors->any())
            <x-lists.errors-list>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </x-lists.errors-list>
            @endif

            <div x-data="{ open: true}"
                class="border border-gray-200 dark:border-gray-600 rounded-mid  my-2 overflow-hidden">
                <button type="button" class="accordion-btn" x-on:click="open = !open"
                    :class="!open ? '' : 'bg-gray-200 dark:bg-gray-900'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 my-auto transition-transform duration-75"
                        :class="!open ? '' : 'rotate-180'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    <span class="ml-1">
                        {{__('basic')}}
                    </span>
                </button>

                <!-- Basic tab -->
                <div class="p-4" x-show="open">

                    <label for="name"
                        class="input-label">{{__('name')}}</label>
                    @error('name')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="text" id="name" name="name"
                        class="input-text"
                        required value="{{ old('name') ? old('name') : $store->name}}" />

                    <label for="order"
                        class="input-label">{{ __('order')}}</label>
                    @error('order')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="number" id="order" name="order"
                        class="input-text"
                        required value="{{old('order') ? old('order') :  $store->order}}" />

                    <label for="color_id"
                        class="input-label">{{ __('select color')}}:</label>
                    @error('color_id')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror

                    <select id="color_id" name="color_id"
                        class="input-text focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        @foreach ($colors as $color)
                        <option style="background-color: {{$color->value}} ;" value="{{$color->id}}" @if($store->
                            color->id == $color->id) selected @endif>{{ $color->name }}</option>
                        @endforeach
                    </select>

                    <label for="email"
                        class="input-label">{{__('email')}}</label>
                    @error('email')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="email" id="email" name="email"
                        class=" input-text"
                        required value="{{ old('email') ? old('email') : $store->email}}" />

                    <label for="phone"
                        class="input-label">{{__('phone')}}</label>
                    @error('phone')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="text" id="phone" name="phone"
                        class=" input-text"
                        required value="{{old('phone') ? old('phone') : $store->phone}}" />

                </div>
            </div>


            <!-- Address tab -->
            <div x-data="{ open: false}"
                class="border border-gray-200 dark:border-gray-600 rounded-mid  my-2 overflow-hidden">
                <button type="button" class="accordion-btn" x-on:click="open = !open"
                    :class="!open ? '' : 'bg-gray-200 dark:bg-gray-900'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 my-auto transition-transform duration-75"
                        :class="!open ? '' : 'rotate-180'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    <span class="ml-1">
                        {{__('address')}}
                    </span>
                </button>

                <!-- Address tab -->
                <div class="p-4" x-show="open">
                    <label for="city"
                        class="input-label">{{__('city')}}</label>
                    @error('city')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="text" id="city" name="city"
                        class=" input-text"
                        required value="{{old('city') ? old('city') : $store->city}}" />

                    <label for="postcode"
                        class="input-label">{{__('postcode')}}</label>
                    @error('postcode')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="text" id="postcode" name="postcode"
                        class=" input-text"
                        required value="{{old('postcode') ? old('postcode') : $store->postcode}}" />

                    <label for="street"
                        class="input-label">{{__('street')}}</label>
                    @error('street')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="text" id="street" name="street"
                        class=" input-text"
                        required value="{{old('street') ? old('street') : $store->street}}" />

                    <label for="building_number"
                        class="input-label">{{__('building_number')}}</label>
                    @error('building_number')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="text" id="building_number" name="building_number"
                        class=" input-text"
                        required
                        value="{{old('building_number') ? old('building_number') : $store->building_number}}" />

                    <label for="apartment_number"
                        class="input-label">{{__('apartment_number')}}</label>
                    @error('apartment_number')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="text" id="apartment_number" name="apartment_number"
                        class=" input-text"
                        required
                        value="{{old('apartment_number') ? old('apartment_number') : $store->apartment_number}}" />
                </div>
            </div>

            <!-- Prefixes tab -->
            <div x-data="{ open: false}"
                class="border border-gray-200 dark:border-gray-600 rounded-mid  my-2 overflow-hidden">
                <button type="button" class="accordion-btn" x-on:click="open = !open"
                    :class="!open ? '' : 'bg-gray-200 dark:bg-gray-900'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 my-auto transition-transform duration-75"
                        :class="!open ? '' : 'rotate-180'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    <span class="ml-1">
                        {{__('prefixes')}}
                    </span>
                </button>

                <!-- Prefixes tab -->
                <div class="p-4" x-show="open">
                    <label for="contracts_prefix"
                        class="input-label">{{__('contracts_prefix')}}</label>
                    @error('contracts_prefix')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="text" id="contracts_prefix" name="contracts_prefix"
                        class=" input-text"
                        required
                        value="{{old('contracts_prefix') ? old('contracts_prefix') : $store->contracts_prefix}}" />

                    <label for="invoices_prefix"
                        class="input-label">{{__('invoices_prefix')}}</label>
                    @error('invoices_prefix')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="text" id="invoices_prefix" name="invoices_prefix"
                        class=" input-text"
                        required
                        value="{{old('invoices_prefix') ? old('invoices_prefix') : $store->invoices_prefix}}" />

                    <label for="margin_invoices_prefix"
                        class="input-label">{{__('margin_invoices_prefix')}}</label>
                    @error('margin_invoices_prefix')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="text" id="margin_invoices_prefix" name="margin_invoices_prefix"
                        class=" input-text"
                        required
                        value="{{old('margin_invoices_prefix') ? old('margin_invoices_prefix') : $store->margin_invoices_prefix}}" />

                    <label for="proforma_invoices_prefix"
                        class="input-label">{{__('proforma_invoices_prefix')}}</label>
                    @error('proforma_invoices_prefix')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="text" id="proforma_invoices_prefix" name="proforma_invoices_prefix"
                        class=" input-text"
                        required
                        value="{{old('proforma_invoices_prefix') ? old('proforma_invoices_prefix') : $store->proforma_invoices_prefix}}" />

                    <label for="internal_servicing_prefix"
                        class="input-label">{{__('internal_servicing_prefix')}}</label>
                    @error('internal_servicing_prefix')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="text" id="internal_servicing_prefix" name="internal_servicing_prefix"
                        class=" input-text"
                        required
                        value="{{old('internal_servicing_prefix') ? old('internal_servicing_prefix') : $store->internal_servicing_prefix}}" />

                    <label for="external_servicing_prefix"
                        class="input-label">{{__('external_servicing_prefix')}}</label>
                    @error('external_servicing_prefix')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="text" id="external_servicing_prefix" name="external_servicing_prefix"
                        class=" input-text"
                        required
                        value="{{old('external_servicing_prefix') ? old('external_servicing_prefix') : $store->external_servicing_prefix}}" />
                </div>
            </div>

            <!-- Indexes tab -->
            <div x-data="{ open: false}"
                class="border border-gray-200 dark:border-gray-600 rounded-mid  my-2 overflow-hidden">
                <button type="button" class="accordion-btn" x-on:click="open = !open"
                    :class="!open ? '' : 'bg-gray-200 dark:bg-gray-900'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 my-auto transition-transform duration-75"
                        :class="!open ? '' : 'rotate-180'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    <span class="ml-1">
                        {{__('indexes')}}
                    </span>
                </button>

                <!-- Indexes tab -->
                <div class="p-4" x-show="open">
                    <label for="next_receipt_number"
                        class="input-label">{{__('next_receipt_number')}}</label>
                    @error('next_receipt_number')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="number" id="next_receipt_number" name="next_receipt_number"
                        class=" input-text"
                        required
                        value="{{old('next_receipt_number') ? old('next_receipt_number') : $store->next_receipt_number}}" />

                    <label for="next_invoice_number"
                        class="input-label">{{__('next_invoice_number')}}</label>
                    @error('next_invoice_number')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="number" id="next_invoice_number" name="next_invoice_number"
                        class=" input-text"
                        required
                        value="{{old('next_invoice_number') ? old('next_invoice_number') : $store->next_invoice_number}}" />

                    <label for="next_margin_invoice_number"
                        class="input-label">{{__('next_margin_invoice_number')}}</label>
                    @error('next_margin_invoice_number')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="number" id="next_margin_invoice_number" name="next_margin_invoice_number"
                        class=" input-text"
                        required
                        value="{{old('next_margin_invoice_number') ? old('next_margin_invoice_number') : $store->next_margin_invoice_number}}" />

                    <label for="next_proforma_invoice_number"
                        class="input-label">{{__('next_proforma_invoice_number')}}</label>
                    @error('next_proforma_invoice_number')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="number" id="next_proforma_invoice_number" name="next_proforma_invoice_number"
                        class=" input-text"
                        required
                        value="{{old('next_proforma_invoice_number') ? old('next_proforma_invoice_number') : $store->next_proforma_invoice_number}}" />

                    <label for="next_internal_servicing_number"
                        class="input-label">{{__('next_internal_servicing_number')}}</label>
                    @error('next_internal_servicing_number')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="number" id="next_internal_servicing_number" name="next_internal_servicing_number"
                        class=" input-text"
                        required
                        value="{{old('next_internal_servicing_number') ? old('next_internal_servicing_number') : $store->next_internal_servicing_number}}" />

                    <label for="next_external_servicing_number"
                        class="input-label">{{__('next_external_servicing_number')}}</label>
                    @error('next_external_servicing_number')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <input type="number" id="next_external_servicing_number" name="next_external_servicing_number"
                        class=" input-text"
                        required
                        value="{{old('next_external_servicing_number') ? old('next_external_servicing_number') : $store->next_external_servicing_number}}" />
                </div>
            </div>

            <!-- Description tab -->
            <div x-data="{ open: false}"
                class="border border-gray-200 dark:border-gray-600 rounded-mid  my-2 overflow-hidden">
                <button type="button" class="accordion-btn" x-on:click="open = !open"
                    :class="!open ? '' : 'bg-gray-200 dark:bg-gray-900'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 my-auto transition-transform duration-75"
                        :class="!open ? '' : 'rotate-180'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    <span class="ml-1">
                        {{__('description')}}
                    </span>
                </button>

                <!-- Description tab -->
                <div class="p-4" x-show="open">
                    <label for="description"
                        class="input-label">{{__('description')}}</label>
                    @error('description')
                    <div class="text-red-500 dark:text-red-300 ">{{ $message }}</div>
                    @enderror
                    <textarea id="description" name="description"
                        class=" input-text"
                        required value="{{old('description') ? old('description') : $store->description}}">
                                </textarea>

                </div>
            </div>

            <x-submit-cancel-btns :cancelRoute="'store.index'" :type="'update'" />

        </form>

    </x-window>

</x-app-layout>
