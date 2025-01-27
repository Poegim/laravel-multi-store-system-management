<?php

namespace App\Repositories\TemporaryExternalInvoiceItemRepository;

interface TemporaryExternalInvoiceItemRepositoryInterface
{
    public function store(array $data);
    public function update(array $data, int $id);
}