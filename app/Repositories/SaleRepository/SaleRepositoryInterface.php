<?php

namespace App\Repositories\SaleRepository;

use App\Models\Commerce\Sale;

interface SaleRepositoryInterface
{
    public function getActiveSale($storeId): Sale;
}