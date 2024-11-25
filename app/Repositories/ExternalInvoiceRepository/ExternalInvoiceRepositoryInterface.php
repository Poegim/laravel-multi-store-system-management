<?php

namespace App\Repositories\ExternalInvoiceRepository ;

use App\Models\Commerce\ExternalInvoice;


interface ExternalInvoiceRepositoryInterface
{
    public function store(array $data);
    public function update(array $data, ExternalInvoice $externalInvoice);
}