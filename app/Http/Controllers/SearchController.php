<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse\Product;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function getData(Request $request)
    {
        // Rozpocznij zapytanie
        $query = Product::devices();
    
        // Sprawdzanie, czy w żądaniu jest przekazany parametr wyszukiwania
        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            
            // Użycie 'name' lub innego odpowiedniego pola w modelu Product
            $query->where('name', 'like', '%' . $search . '%');
        }
    
        // Pobranie danych
        try {
            $data = $query->get(); // Pobieramy dane
            return response()->json(['data' => $data]); // Zwracamy dane w odpowiednim formacie
        } catch (\Exception $e) {
            // Logowanie błędu
            Log::error('Błąd w getData: ' . $e->getMessage());
            return response()->json(['error' => 'Błąd podczas ładowania danych. Spróbuj ponownie.'], 500);
        }
    }
}
