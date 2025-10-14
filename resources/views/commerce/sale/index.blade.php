<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb md:text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="top-header-breadcrumb-title">
                {{ __('Sales List') }}
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

        <div>
            <div class="flex gap-2 pb-2">
                <a href="{{ route('sale.index', array_filter([
                    'store' => $storeId ?? null,
                    'dateStart' => now()->format('Y-m-d'),
                    'dateEnd' => now()->format('Y-m-d'),
                ])) }}">
                    <x-button>
                        {{ __('Today') }}
                    </x-button>
                </a>

                <a href="{{ route('sale.index', array_filter([
                    'store' => $storeId ?? null,
                    'dateStart' => now()->startOfMonth()->format('Y-m-d'),
                    'dateEnd' => now()->endOfMonth()->format('Y-m-d'),
                ])) }}">
                    <x-button>
                        {{ __('This month') }}
                    </x-button>
                </a>

                <a href="{{ route('sale.index', array_filter([
                    'store' => $storeId ?? null,
                    'dateStart' => now()->startOfYear()->format('Y-m-d'),
                    'dateEnd' => now()->endOfYear()->format('Y-m-d'),
                ])) }}">
                    <x-button>
                        {{ __('This year') }}
                    </x-button>
                </a>

            </div>
            <div>
                <form 
                action="{{ route('sale.index', array_filter(['store' => $storeId ?? null])) }}" 
                method="GET"
                class="flex flex-wrap items-center gap-3 bg-white mb-2"
            >
                <input type="hidden" name="store" value="{{ $storeId ?? '' }}">

                <span class="text-sm font-medium text-gray-700">
                    {{ __('Choose dates range') }}
                </span>

                <input 
                    type="date" 
                    name="dateStart" 
                    value="{{ request('dateStart', now()->format('Y-m-d')) }}"
                    max="{{ request('dateEnd', now()->format('Y-m-d')) }}"
                    class="rounded h-8 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm px-3 py-2"
                />

                <input 
                    type="date" 
                    name="dateEnd" 
                    value="{{ request('dateEnd', now()->format('Y-m-d')) }}"
                    class="rounded h-8 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm px-3 py-2"
                />

                <x-button type="submit">
                    {{ __('Apply') }}
                </x-button>
            </form>



            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-2">{{ __('ID') }}</th>
                        <th scope="col" class="p-2">{{ __('Sold At') }}</th>
                        <th scope="col" class="p-2">{{ __('List') }}</th>
                        <th scope="col" class="p-2">{{ __('Total Price') }}</th>
                        @if(!$storeId)
                        <th scope="col" class="p-2">{{ __('Store') }}</th>
                        @endif
                        <th scope="col" class="p-2">{{ __('User') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="p-2">
                                <a href="{{route('sale.show', [$sale, $sale->store])}}" class="link">
                                    {{ $sale->id }}
                                </a>
                            </td>
                            <td class="p-2 text-xs bg-red- w-0 whitespace-nowrap">{{ $sale->sold_at->format('Y-m-d H:i') }}</td>
                            <td class="p-2">
                                <div>
                                    <ul class="rounded border bg-white shadow-md space-y-1 text-sm text-gray-600">
                                        @foreach($sale->stockItems as $item)
                                            <li class="border-b last:border-0 flex text-xs p-1 justify-between">
                                                <span>{{ $item->brand->name }} {{ $item->productVariant->product->name }} ({{ $item->productVariant->name }})</span>
                                                <span class="font-semibold {{ $item->pivot->price < $item->purchase_price_gross ? 'text-red-600' : '' }} {{ $item->pivot->price > $item->purchase_price_gross ? 'text-green-600' : '' }}">
                                                    <span>
                                                        {{ number_format($item->pivot->price / 100, 2, '.', ' ') }}
                                                    </span>
                                                    <span class="text-xs italic font-normal">
                                                        [{{ $item->pivot->price - $item->purchase_price_gross < 0 ? '-' : '+' }}{{ number_format(abs($item->pivot->price - $item->purchase_price_gross) / 100, 2, '.', ' ') }}]
                                                    </span>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if(($sale->contact) || ($sale->nip_number))
                                <div class=" rounded border shadow-md space-y-1 text-xs p-1 text-gray-70 bg-gray-200">                               
                                    @if($sale->contact)
                                    <div class="flex items-center gap-2 text-gray-800">
                                        <span class="font-semibold">{{ __('Customer:') }}</span>
                                        <a href="{{ route('contact.show', $sale->contact) }}" class="text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200">
                                            {{ $sale->contact->name }}
                                        </a>
                                        <p>
                                            ({{ $sale->contact->identification_number }})
                                        </p>
                                    </div>
                                    @endif
                                    
                                    {{-- NIP number --}}
                                    @if($sale->nip_number)
                                        <div class="nip italic text-gray-700 mt-1">
                                            <span class="font-semibold">{{ __('NIP:') }}</span> {{ $sale->nip_number }}
                                        </div>
                                    @endif
                                </div>
                                @endif
                            </td>
                            <td class="p-2 font-semibold text-black">
                                {{ number_format($sale->stockItems->sum(function($item) {
                                    return $item->pivot->price / 100; // convert cents to dollars
                                }), 2, '.', ' ') }}
                            </td>
                            @if(!$storeId)
                            <td class="p-2">
                                <div class="flex items-center">
                                    <div class="rounded-full w-10 h-10 md:h-6 md:w-6 object-cover mr-2 my-auto mb-4 md:mb-0" style="background-color: {{ $sale->store->color->value }};">
                                        
                                    </div>
                                    <div>
                                        {{ $sale->store->invoices_prefix }}
                                    </div>
                                </div>
                            </td>
                            @endif
                            <td class="p-2">
                            <div class="flex">
                                <img src="{{ $sale->user->profile_photo_url }}" alt="{{ $sale->user->name }}"
                                class="rounded-full w-12 h-12 md:h-8 md:w-8 object-cover mr-2 my-auto mb-4 md:mb-0">
                                <div class="my-auto">
                                    {{$sale->user->name}}
                                </div>
                            </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="p-2 text-center" colspan="6">{{ __('No sales found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-2">
            {{ $sales->links() }}
        </div>
    </x-window>

    
</x-app-layout>
