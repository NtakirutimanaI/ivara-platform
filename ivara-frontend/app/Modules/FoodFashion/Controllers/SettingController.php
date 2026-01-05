<?php

namespace App\Modules\FoodFashion\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\FoodFashion\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() { $settings = Setting::latest()->paginate(10); return view('admin.categories.food-fashion.settings', compact('settings')); }
    public function create() { return view('admin.categories.food-fashion.settings_create'); }
    public function store(Request $request) { Setting::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.food-fashion.settings')->with('success','Created'); }
    public function edit($id) { $setting = Setting::findOrFail($id); return view('admin.categories.food-fashion.settings_edit', compact('setting')); }
    public function update(Request $request, $id) { Setting::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.food-fashion.settings')->with('success','Updated'); }
    public function destroy($id) { Setting::findOrFail($id)->delete(); return redirect()->route('admin.food-fashion.settings')->with('success','Deleted'); }
}
