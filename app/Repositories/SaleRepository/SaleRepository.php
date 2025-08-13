<?php 

namespace App\Repositories\SaleRepository;

use App\Models\Commerce\Sale;

class SaleRepository implements SaleRepositoryInterface
{
    public function getActiveSale($storeId): Sale
    {
        return Sale::firstOrCreate([
            'store_id' => $storeId,
            'user_id' => auth()->id(),
            'status' => Sale::PENDING,
        ], [
            'store_id' => $storeId,
            'user_id' => auth()->id(),
            'status' => Sale::PENDING,
        ]);
    }
}