<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Commerce\Sale;
use App\Models\Warehouse\StockItem;
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

    public function finalizeSale(Sale $sale, string $nipNumber, ?int $selectedContactId, string $receiptType): bool
    {
        $sale->nip_number = $nipNumber;
        $selectedContactId ? $sale->contact_id = $selectedContactId : null;
        $sale->document_type = match ($receiptType) {
            'receipt' => Sale::RECEIPT,
            'receipt_nip' => Sale::RECEIPT_NIP,
            'invoice' => Sale::INVOICE,
        };
        $sale->status = Sale::COMPLETED;
        $sale->sold_at = now();

        foreach ($sale->stockItems as $item) {
            $item->status = StockItem::SOLD;
            $item->pivot->sold_at = now();
            $item->updated_at = now();
            $item->save();
        }

        return $sale->save();
    }

}