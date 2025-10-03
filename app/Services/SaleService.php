<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Commerce\Sale;
use App\Models\Warehouse\StockItem;
use Illuminate\Validation\ValidationException;
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

        // Validate that all pivot prices are > 0
        foreach ($sale->stockItems as $item) {
            // You can access pivot data with $item->pivot->sold_price
            if ($item->pivot->price <= 0) {
                throw ValidationException::withMessages([
                    'sold_price' => 'Each item must have a price greater than 0. Item ID: ' . $item->id,
                ]);
            }
        }
        
        foreach ($sale->stockItems as $item) {
            
            $item->status = StockItem::SOLD;
            $item->save();
            $sale->stockItems()->updateExistingPivot($item->id, [
                'sold_at' => now(),
                'vat_rate' => $item->vatRate->rate,
            ]);
        }
        
        $sale->status = Sale::COMPLETED;
        $sale->sold_at = now();
        return $sale->save();
    }

}