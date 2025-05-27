<?php

namespace App\Livewire\Commerce\ExternalInvoice;

use Livewire\Component;
use App\Models\Commerce\ExternalInvoice;

class ShowExternalInvoice extends Component
{
    public ExternalInvoice $externalInvoice;

    public function mount(ExternalInvoice $externalInvoice) {
        $this->externalInvoice = $externalInvoice;
    }

    public function render()
    {
        return view('livewire.commerce.external-invoice.show-external-invoice', [
            'externalInvoice' => $this->externalInvoice,
        ]);
    }
    

}
