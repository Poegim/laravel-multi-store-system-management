<?php

namespace App\Http\Controllers\Warehouse;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    public function index()
    {
        return view('warehouse.color.index');
    }

    public function create()
    {
        return view('warehouse.color.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:35|unique:colors,name',
            'value' => 'required|hex_color|unique:colors,value',
        ]);
        
        $color = new Color();
        $color->name = $request->name;          
        $color->value = $request->value;
        $color->user_id = auth()->user()->id;
        $color->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $color->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $color->save();
        
        session()->flash('flash.banner', __('Successfully created color: :name!', ['name' => $color->name]));
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('color.index');

    }

    public function edit(Color $color)
    {
        return view('warehouse.color.edit', compact('color'));
    }

    public function update(Color $color, Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:35|unique:colors,name,' . $color->id,
            'value' => 'required|hex_color|unique:colors,value,' . $color->id,
        ]);
        
        $color->name = $request->name;          
        $color->value = $request->value;
        $color->user_id = auth()->user()->id;
        $color->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $color->save();
        
        session()->flash('flash.banner', __('Successfully updated color: :name!', ['name' => $color->name]));
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('color.index');
    }

}
