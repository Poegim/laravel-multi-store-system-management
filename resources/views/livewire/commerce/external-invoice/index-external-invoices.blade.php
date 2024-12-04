<div >
    <x-window>

        <div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase">
                    <tr class="text-black dark:text-white">
                        <th scope="col" class="px-6 py-3">
                            <div class="flex cursor-pointer" wire:click="sortBy('id')">
                                <span class="uppercase">
                                    {{__('id')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="size-4 {{ $sortField === 'id' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex cursor-pointer" wire:click="sortBy('invoice_number')">
                                <span class="uppercase">
                                    {{__('invoice_number')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="size-4 {{ $sortField === 'invoice_number' ? ($sortAsc == false ? 'rotate-180' : 'rotate-0') : '' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                                <span class="uppercase">
                                    {{__('contact')}}
                                </span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                                <span class="uppercase">
                                    {{__('store')}}
                                </span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex cursor-pointer">
                                <span class="uppercase">
                                    {{__('created_by')}}
                                </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex cursor-pointer">
                                <span class="uppercase">
                                    {{__('created_at')}}
                                </span>
                            </div>
                        </th>
                        {{-- <th scope="col" class="px-6 py-3 text-right">

                        </th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if ($externalInvoices)
                    @foreach($externalInvoices as $invoice)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700"
                        wire:key="row-{{ $invoice->id }}">
                        <td class="px-6 py-1 dark:text-gray-100 font-thin">
                            {{$invoice->id}}
                        </td>

                        <td scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex">
                                <a href="{{ route('external-invoice.show', $invoice->id) }}" class="link my-auto" alt="{{$invoice->invoice_number}}"
                                    label="{{$invoice->invoice_number}}">{{Illuminate\Support\Str::limit($invoice->invoice_number, 30, '...')}}</a>
                            </div>
                        </td>
                        
                        <td scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex">
                                <a href="{{ route('contact.show', $invoice->contact) }}" class="link my-auto" alt="{{$invoice->contact->name}}"
                                    label="{{$invoice->contact->name}}">{{Illuminate\Support\Str::limit($invoice->contact->name, 30, '...')}}</a>
                            </div>
                        </td>

                        <td scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $invoice->store->name}}
                        </td>

                        <td class="px-6 py-1 hidden lg:table-cell">
                            <div class="flex">
                                <img src="{{ $invoice->user->profile_photo_url }}" alt="{{ $invoice->user->name }}"
                                class="rounded-full w-12 h-12 md:h-8 md:w-8 object-cover mr-2 my-auto mb-4 md:mb-0">
                                <div class="my-auto">
                                    {{$invoice->user->name}}
                                </div>
                            </div>                        </td>

                        <td class="px-6 py-1 hidden lg:table-cell">
                            {{$invoice->created_at}}
                        </td>

                        {{-- <td class="px-6 py-1 flex justify-end">
                            <a href="{{route('external-invoice.edit', $invoice->id)}}" wire:navigate>
                                <x-buttons.edit-button >
                                    Edit
                                </x-buttons.edit-button>
                            </a>
                        </td> --}}
                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>

        <div class=" m-4">
            {{ $externalInvoices->links() }}
        </div>
    </x-window>

</div>
