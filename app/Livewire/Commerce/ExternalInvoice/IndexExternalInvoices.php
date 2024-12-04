<?php

namespace App\Livewire\Commerce\ExternalInvoice;

use App\Models\Commerce\ExternalInvoice;
use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\Searchable;
use Livewire\WithPagination;

class IndexExternalInvoices extends Component
{
    use Searchable;
    use Sortable;
    use WithPagination;

    public $storeId;

    public function mount(int $storeId = 0)
    {
        $this->storeId = $storeId;
    }
    
    public function render()
    {
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';

        $externalInvoices = ExternalInvoice::query()
        ->when($this->storeId != 0, function ($query) {
            $query->where('store_id', $this->storeId);
        })
        ->where(function ($query) {
            $query->where('invoice_number', 'like', '%' . $this->search . '%')
                ->orWhereHas('contact', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
        })
        ->orderBy($this->sortField, $sortDirection)
        ->paginate(10);
    
        return view('livewire.commerce.external-invoice.index-external-invoices', [
            'externalInvoices' => $externalInvoices,
        ]);
    }
}
