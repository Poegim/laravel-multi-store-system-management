<?php

namespace App\Services;

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

}