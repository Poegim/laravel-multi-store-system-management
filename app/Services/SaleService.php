<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Commerce\Sale;
use App\Models\Warehouse\StockItem;
use Illuminate\Validation\ValidationException;
use App\Repositories\SaleRepository\SaleRepositoryInterface;
use App\Traits\FormatsAmount;

class SaleService
{
    use FormatsAmount;

    public function __construct(
        protected SaleRepositoryInterface $saleRepository
        ) {}

    public function getActiveSale($storeId)
    {
        return $this->saleRepository->getActiveSale($storeId);
    }

    // public function generateReceipt(Sale $sale): array
    // {
    //     $items = $sale->stockItems->groupBy(['brand_id', 'product_variant_id', function ($item) {
    //         return $item->pivot->price;
    //     }]);

    //     return [
    //         'items' => $items->map(function ($brandGroup, $brandId) {
    //             return $brandGroup->map(function ($productVariantGroup, $productVariantId) use ($brandId) {
    //                 return $productVariantGroup->map(function ($itemsWithSamePrice, $price) use ($brandId, $productVariantId) {
    //                     return [
    //                         'brand_id' => $brandId,
    //                         'brand_name' => $itemsWithSamePrice->first()->brand->name,
    //                         'product_variant_id' => $productVariantId,
    //                         'product_name' => $itemsWithSamePrice->first()->productVariant->product->name,
    //                         'unit_price' => $this->integerToDecimal($price),
    //                         'quantity' => $itemsWithSamePrice->count(),
    //                         'total_price' => $this->integerToDecimal($itemsWithSamePrice->count() * $price),
    //                     ];
    //                 })->values();
    //             })->values();
    //         })->flatten(2)->values(),
    //         'total_amount' => $this->integerToDecimal($sale->stockItems->sum(function ($item) {
    //             return $item->pivot->price;
    //         })),
    //     ];
    // }

    public function generateReceipt(Sale $sale): array
    {
        $items = $sale->stockItems->groupBy([
            'brand_id',
            'product_variant_id',
            function ($item) {
                // Group by VAT rate or by VAT margin flag
                return $item->is_vat_margin
                    ? 'vat_margin'
                    : $item->vat_rate_id;
            },
            function ($item) {
                // Group by unit price
                return $item->pivot->price;
            },
        ]);

        return [
            'items' => $items->map(function ($brandGroup, $brandId) {
                return $brandGroup->map(function ($productVariantGroup, $productVariantId) use ($brandId) {
                    return $productVariantGroup->map(function ($vatGroup) use ($brandId, $productVariantId) {
                        return $vatGroup->map(function ($itemsWithSamePrice, $price) use ($brandId, $productVariantId) {
                            return [
                                'brand_id' => $brandId,
                                'brand_name' => $itemsWithSamePrice->first()->brand->name,
                                'product_variant_id' => $productVariantId,
                                'product_name' => $itemsWithSamePrice->first()->productVariant->product->name,
                                'vat_rate' => $itemsWithSamePrice->first()->is_vat_margin
                                    ? null
                                    : $itemsWithSamePrice->first()->vatRate->rate,
                                'is_vat_margin' => $itemsWithSamePrice->first()->is_vat_margin,
                                'unit_price' => $this->integerToDecimal($price),
                                'quantity' => $itemsWithSamePrice->count(),
                                'total_price' => $this->integerToDecimal($itemsWithSamePrice->count() * $price),
                            ];
                        })->values();
                    })->values();
                })->values();
            })->flatten(3)->values(),

            'total_amount' => $this->integerToDecimal(
                $sale->stockItems->sum(fn ($item) => $item->pivot->price)
            ),
        ];
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