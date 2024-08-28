<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Color;
use App\Models\Store;
use Illuminate\View\View;
use App\Services\StoreService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StoreController extends Controller
{
    use AuthorizesRequests;
    
    public function __construct(
        protected StoreService $storeService
        ) {}

    public function index(): View
    {
        return view('management.store.index');
    }

    public function show(Store $store): View 
    {
        return view('management.store.show', compact('store'));
    }

    public function create()
    {
        return view('management.store.create', [
            'colors' => Color::all(),
        ]);
    }

    public function store(StoreStoreRequest $request)
    {
        $this->storeService->store($request->validated());
        session()->flash('flash.banner', __('Successfully created!'));
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('store.index');
    }

    public function edit(Store $store)
    {
        return view('management.store.edit', [
            'store' => $store,
            'colors' => Color::all(),
        ]);
    }

    public function update(UpdateStoreRequest $request)
    {
        $this->storeService->update($request->validated(), $request->route('store'));
        session()->flash('flash.banner', __('Successfully updated!'));
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('store.index');
    }


}
