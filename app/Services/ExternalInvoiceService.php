<?php

namespace App\Services;

use App\Models\Commerce\ExternalInvoice;
use App\Repositories\ExternalInvoiceRepository\ExternalInvoiceRepositoryInterface;

class ExternalInvoiceService
{
    public function __construct(
        protected ExternalInvoiceRepositoryInterface $externalInvoiceRepository,
    ) {}

    public function store(array $data) {
        return $this->externalInvoiceRepository->store($data);
    }

    public function update(array $data, $id)
    {
        return $this->externalInvoiceRepository->update($data, $id);
    }

    public function confirm(ExternalInvoice $externalInvoice)
    {
        return $this->externalInvoiceRepository->confirm($externalInvoice);
    }

    public function destroy(int $id)
    {
        return $this->externalInvoiceRepository->destroy($id);
    }

}