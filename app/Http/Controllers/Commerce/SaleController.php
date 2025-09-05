<?php

namespace App\Http\Controllers\Commerce;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\Commerce\Sale;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $storeId   = $request->query('store');
        $dateStart = $request->query('dateStart');
        $dateEnd   = $request->query('dateEnd');
        $paginate  = $request->query('paginate', 15);

        $request->validate([
            'dateStart' => 'nullable|date|before_or_equal:dateEnd',
            'dateEnd'   => 'nullable|date|after_or_equal:dateStart',
            'store'     => 'nullable|integer|exists:stores,id',
            'paginate'  => 'nullable|integer|min:1',
        ]);

        $salesQuery = Sale::completed();

        if ($storeId) {
            $salesQuery->where('store_id', $storeId);
        }

        // Safe parsing of dates
        try {
            $start = $dateStart ? \Carbon\Carbon::parse($dateStart)->startOfDay() : null;
            $end   = $dateEnd   ? \Carbon\Carbon::parse($dateEnd)->endOfDay() : null;
        } catch (\Exception $e) {
            $start = null;
            $end   = null;
        }

        if ($start && $end) {
            $salesQuery->whereBetween('sold_at', [$start, $end]);
        }

        $sales = $salesQuery->paginate($paginate);

        return view('commerce.sale.index', compact('sales', 'storeId', 'dateStart', 'dateEnd'));
    }

    public function create(Store $store)
    {
        $sale = Sale::firstOrCreate([
            'store_id' => $store->id,
            'user_id' => auth()->id(),
            'status' => Sale::PENDING,
        ], [
            'store_id' => $store->id,
            'user_id' => auth()->id(),
            'status' => Sale::PENDING,
        ]);

        return view('commerce.sale.create', compact('store', 'sale'));
    }

    public function show(Sale $sale, Store $store) {
        if($sale->store_id !== $store->id) {
            abort(403, 'The sale does not belong to the specified store.');
        }
        return view('commerce.sale.show', compact('sale'));
    }
    
    
}
