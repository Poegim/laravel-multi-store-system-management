<?php

namespace App\Livewire\Warehouse\StockItem;

use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\Searchable;
use Livewire\WithPagination;
use App\Models\Warehouse\StockItem;
use App\Services\SaleService;
use App\Services\StockItemService;
use App\Traits\ReturnItemStatusInfo;

class IndexStockItems extends Component
{
    use Searchable;
    use Sortable;
    use WithPagination;
    use ReturnItemStatusInfo;

    protected StockItemService $stockItemService;
    protected SaleService $saleService;

    protected $queryString = [
        'filters' => ['except' => null],  // synchronizuje $filters z query stringiem, ale nie pokazuje gdy null
        'search' => ['except' => ''],     // dla przykładu synchronizujemy też search
        'sortField' => ['except' => 'id'],
        'sortAsc' => ['except' => true],
        'perPage' => ['except' => 10],
    ];

    public $store;
    public int $perPage = 10;
    public $filters = null;

    public function boot(StockItemService $stockItemService, SaleService $saleService)
    {
        $this->stockItemService = $stockItemService;
        $this->saleService = $saleService;

    }

    public function mount($store = null)
    {
        $this->store = $store;
    }

    public function filterByBrand($brand)
    {
        $this->filters['brand_id'] = $brand;
        $this->resetPage();
    }

    public function filterByProduct($product)
    {
        $this->filters['product_id'] = $product;
        $this->resetPage();
    }

    public function removeFilter($key)
    {
        if ($this->filters && isset($this->filters[$key])) {
            unset($this->filters[$key]);
            if (empty($this->filters)) {
                $this->filters = null;
            }
            $this->resetPage();
        }
    }

    public function clearFilters()
    {
        $this->filters = null;
        $this->resetPage();
    }

    public function addToSale($item)
    {
        $sale = $this->saleService->getActiveSale($this->store->id);

        $stockItem = StockItem::where('id', $item['id'])->where('store_id', $this->store->id)
            ->where(function ($query) use ($sale) {
                $query->whereNull('sale_id')
                      ->orWhere('sale_id', $sale->id);
            })
            ->where('status', StockItem::AVAILABLE)
            ->first();

        if (!$stockItem) {
            $checkItem = StockItem::where('id', $item['id'])->first();
            if ($checkItem) {
                $this->addError('searchItem', 'Item #' . $checkItem->id . ' | ' . $this->returnItemStatusInfo($checkItem->id));
            } else {
                $this->addError('searchItem', 'This item does not exist.');
            }
        } else {
            if ($sale->items->contains($stockItem->id)) {
                $this->addError('searchItem', "This item is already added to the on-going sale id:{$stockItem->sale->id} of user {$stockItem->sale->user->name}.");
            } else {
                $this->resetErrorBag();
                // $sale->items()->save($stockItem);
                $this->stockItemService->assignToSale($stockItem, $sale->id);
                $this->dispatch('item-added');
            }
        }
    }

    public function removeStockItemFromSale($item)
    {
        $stockItem = StockItem::find($item['id']);

        if (!$stockItem) {
            $this->addError('searchItem', 'This item does not exist.');
            return;
        }

        if ($stockItem->status !== StockItem::IN_PENDING_SALE) {
            $this->addError('searchItem', $this->returnItemStatusInfo($stockItem->id));
            return;
        }

        $this->stockItemService->removeFromSale($stockItem);
        $this->dispatch('item-removed');
    }


    public function render()
    {   
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';

        $stockItemsQuery = StockItem::with(['productVariant.product.brand', 'vatRate', 'brand', 'externalInvoice', 'sale'])
            ->where(function ($query) {
                $query->where('stock_items.id', 'like', '%' . $this->search . '%')
                      ->orWhereHas('productVariant.product', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      })->orWhereHas('brand', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      });
            })
            ->orderBy('stock_items.' . $this->sortField, $sortDirection);

        // If there is a filter applied
        if (!empty($this->filters)) {
            foreach ($this->filters as $key => $value) {
            if (!$value) continue;

                switch ($key) {
                    case 'brand_id':
                        $stockItemsQuery->where('brand_id', $value);
                        break;

                    case 'product_id':
                        $stockItemsQuery->whereHas('productVariant.product', function ($query) use ($value) {
                            $query->where('id', $value);
                        });
                        break;

                    // Add more cases for other filters as needed
                    default:
                        $stockItemsQuery->where($key, $value);
                        break;
                }
            }

        }

        // If store is set, filter by store
        if ($this->store) {
            $stockItemsQuery->where('store_id', $this->store->id);
        }

        // Paginate the results
        $stockItemsQuery = $stockItemsQuery->paginate($this->perPage);
        $stockItems = $stockItemsQuery;

        return view('livewire.warehouse.stock-item.index-stock-items', compact('stockItems'));
    }
}
