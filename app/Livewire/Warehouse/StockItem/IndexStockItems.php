<?php

namespace App\Livewire\Warehouse\StockItem;

use App\Models\Store;
use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\Searchable;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use App\Models\Warehouse\StockItem;

class IndexStockItems extends Component
{
    use Searchable;
    use Sortable;
    use WithPagination;

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


    public function render()
    {   
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';

        $stockItemsQuery = StockItem::available()->with(['productVariant.product.brand', 'vatRate', 'brand', 'externalInvoice'])
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

                    // Dodaj inne przypadki jeśli pojawią się nowe filtry
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

        // If store is set, fetch stock items for that store
        // Otherwise, fetch all stock items
        $stockItems = $stockItemsQuery;

        // dd($stockItems);

        return view('livewire.warehouse.stock-item.index-stock-items', compact('stockItems'));
    }
}
