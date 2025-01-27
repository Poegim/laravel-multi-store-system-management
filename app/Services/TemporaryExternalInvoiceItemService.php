<?php

namespace App\Services;

use App\Repositories\TemporaryExternalInvoiceItemRepository\TemporaryExternalInvoiceItemRepositoryInterface;

class TemporaryExternalInvoiceItemService
{
    public function __construct(
        protected TemporaryExternalInvoiceItemRepositoryInterface $TemporaryExternalInvoiceItemRepository
    ) {}

    public function store(array $data) {
        return $this->TemporaryExternalInvoiceItemRepository->store($data);
    }

    public function update(array $data, $id)
    {
        return $this->TemporaryExternalInvoiceItemRepository->update($data, $id);
    }

}