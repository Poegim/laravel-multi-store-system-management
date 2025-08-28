<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Commerce\Sale;
use App\Repositories\SaleRepository\SaleRepositoryInterface;

class SaleService
{
    public function __construct(
        protected SaleRepositoryInterface $saleRepository
        ) {}

    public function getActiveSale($storeId)
    {
        return $this->saleRepository->getActiveSale($storeId);
    }

    public function finalizeSale(Sale $sale, string $nipNumber, ?Contact $selectedContact, string $receiptType): bool
    {
        $sale->nip_number = $nipNumber;
        $sale->contact_id = $selectedContact;
        $sale->document_type = match ($receiptType) {
            'receipt' => Sale::RECEIPT,
            'receipt_nip' => Sale::RECEIPT_NIP,
            'invoice' => Sale::INVOICE,
        };

        $sale->status = Sale::COMPLETED;
        return $sale->save();
    }

}