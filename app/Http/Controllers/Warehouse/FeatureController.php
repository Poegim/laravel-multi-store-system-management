<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Models\Warehouse\Feature;
use App\Services\FeatureService;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function __construct(
        protected FeatureService $featureService,
        ) {}

    public function index()
    {
        return view('warehouse.feature.index');
    }

    public function show(string $slug)
    {
        $feature = Feature::where('slug', $slug)->with('productVariants')->first();
        return view('warehouse.feature.show', [
            'feature' => $feature,
        ]);
    }

    public function create()
    {
        return view('warehouse.feature.create');
    }

    public function store(StoreFeatureRequest $request) 
    {
        $this->featureService->store($request->validated());
        session()->flash('flash.banner', __('Successfully created!'));
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('feature.index');
    }

    public function edit(string $slug) 
    {
        $feature = Feature::where('slug', $slug)->firstOrFail();
        return view('warehouse.feature.edit', compact('feature'));
    }

    public function update(UpdateFeatureRequest $request, string $slug)
    {
        $feature = Feature::where('slug', $slug)->firstOrFail();
        $this->featureService->update($request->validated(), $feature);
        session()->flash('flash.banner', __('Successfully updated!'));
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('feature.index');
    }
}
