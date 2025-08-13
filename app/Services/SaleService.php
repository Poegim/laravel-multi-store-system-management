<?php

namespace App\Services;

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
    
}