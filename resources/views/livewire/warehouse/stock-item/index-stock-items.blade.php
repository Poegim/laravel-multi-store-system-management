<x-window>
    <table class="text-sm">
        <thead>
            <tr>
                <th class="text-left">{{ __('Id') }}</th>
                <th class="text-left">{{ __('Brand') }}</th>
                <th class="text-left">{{ __('Item Name') }}</th>
                <th class="text-left">{{ __('Variant') }}</th>
                <th class="text-left">{{ __('Quantity') }}</th>
                <th class="text-left">{{ __('Unit Price') }}</th>
                <th class="text-left">{{ __('Unit SRP') }}</th>
                <th class="text-left">{{ __('VAT Rate') }}</th>
                <th class="text-left">{{ __('Total Value') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stockItems as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->brand->name }}</td>
                    <td>{{ $item->productVariant->product->name }}</td>
                    <td>{{ $item->productVariant->name }}</td>
                    <td>{{ $item->vatRate->rate }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit_price }}</td>
                    <td>{{ $item->total_value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-window>