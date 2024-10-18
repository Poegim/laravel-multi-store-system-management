<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class SearchController extends Controller
{

    public function getData(Request $request)
    {
        // Init query.
        $query = Product::devices();

        //Check for param.
        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Get data.
        try {
            $data = $query->get();
            return response()->json(['data' => $data]);
        } catch (\Exception $e) {

            // Log errors
            Log::error('Error in getData: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to load data, try again.'], 500);
        }
    }
}
