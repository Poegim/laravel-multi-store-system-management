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

    public function show(Sale $sale) {
        dd($sale);
    }
    
    
}
