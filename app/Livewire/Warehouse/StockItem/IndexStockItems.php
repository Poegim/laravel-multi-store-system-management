<?php

namespace App\Livewire\Warehouse\StockItem;

use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\Searchable;
use Livewire\WithPagination;
use App\Models\Commerce\Sale;
use App\Services\SaleService;
use App\Models\Warehouse\Brand;
use App\Models\Warehouse\Product;
use App\Services\StockItemService;
use App\Models\Warehouse\StockItem;
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
        'filters' => ['except' => null],  // syncing filters but excluding null value
        'search' => ['except' => ''],     // syncing search but excluding empty string
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
        $this->filters['brand_id'] = is_array($brand) ? $brand['id'] : $brand;
        $this->resetPage();
    }

    public function filterByProduct($product)
    {
        $this->filters['product_id'] = is_array($product) ? $product['id'] : $product;
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

        // find stock item
        $stockItem = StockItem::where('id', $item)
            ->first();

        // if not found or not available
        if (!$stockItem) {
            // item does not exist
            $checkItem = StockItem::find($item);
            if ($checkItem) {
                $this->addError('searchItem', 'Item #' . $checkItem->id . ' | ' . $this->returnItemStatusInfo($checkItem->id));
            } else {
                $this->addError('searchItem', 'This item does not exist.');
            }
            return;
        } else {
            // check status
            if ($stockItem->status !== StockItem::AVAILABLE) {
                $this->addError('searchItem', $this->returnItemStatusInfo($stockItem->id));
                return;
            }
            // check store
            if($stockItem->store_id !== $this->store->id) {
                $this->addError('searchItem', 'This item does not belong to the current store.');
                return;
            }
        }

        // check if already in sale
        if ($sale->stockItems()->where('stock_item_id', $stockItem->id)->exists()) {
            $this->addError(
                'searchItem', 
                "This item is already added to the on-going sale id: {$sale->id} of user {$sale->user->name}."
            );
            return;
        }

        // assign to sale
        $this->resetErrorBag();
        $this->stockItemService->assignToSale($stockItem, $sale);
        $this->dispatch('item-added');
    }


    public function removeStockItemFromSale($item, $saleId)
    {
        $stockItem = StockItem::find($item);

        if (!$stockItem) {
            $this->addError('searchItem', 'This item does not exist.');
            return;
        }

        if ($stockItem->status !== StockItem::IN_PENDING_SALE) {
            $this->addError('searchItem', $this->returnItemStatusInfo($stockItem->id));
            return;
        }

        $sale = Sale::find($saleId);
        if (!$sale) {
            $this->addError('searchItem', 'The sale does not exist.');
            return;
        }

        $sale->stockItems()->detach($stockItem->id);

        $stockItem->status = StockItem::AVAILABLE;
        $stockItem->save();

        $this->dispatch('item-removed');
    }


    public function render()
    {   
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';

        $stockItemsQuery = StockItem::inStock()->with(['productVariant.product.brand', 'vatRate', 'brand', 'externalInvoice', 'sales'])
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

        $filterLabels = [];

        if (!empty($this->filters)) {
            foreach ($this->filters as $key => $id) {
                switch ($key) {
                    case 'brand_id':
                        $filterLabels[$key] = Brand::find($id)?->name;
                        break;
                    case 'product_id':
                        $filterLabels[$key] = Product::find($id)?->name;
                        break;
                    default:
                        $filterLabels[$key] = $id;
                }
            }
        }

        $this->store ? $userPendingSale = auth()->user()->pendingSale($this->store->id)->first() : $userPendingSale = null;

        return view('livewire.warehouse.stock-item.index-stock-items', compact('stockItems', 'userPendingSale', 'filterLabels'));
    }
}
