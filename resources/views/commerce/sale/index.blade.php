<x-app-layout>
    <x-window>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-2">{{ __('ID') }}</th>
                        <th scope="col" class="p-2">{{ __('Store') }}</th>
                        <th scope="col" class="p-2 text-right">{{ __('Total Items') }}</th>
                        <th scope="col" class="p-2 text-right">{{ __('Total Price') }}</th>
                        <th scope="col" class="p-2">{{ __('Created At') }}</th>
                        <th scope="col" class="p-2">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="p-2">{{ $sale->id }}</td>
                            <td class="p-2">{{ $sale->store->name }}</td>
                            <td class="p-2 text-right">{{ $sale->stockItems->count() }}</td>
                            <td class="p-2 text-right font-semibold">
                                {{ number_format($sale->stockItems->sum(function($item) {
                                    return $item->pivot->price / 100; // convert cents to dollars
                                }), 2, '.', ' ') }}
                            </td>
                                <td class="p-2">{{ $sale->sold_at->format('Y-m-d H:i') }}</td>
                            <td class="p-2 text-blue-600">
                                {{-- <a href="{{ route('commerce.sales.show', ['sale' => $sale->id]) }}" class="hover:underline">
                                    {{ __('View') }}
                                </a> --}}
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
