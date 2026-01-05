<?php

namespace App\Modules\FoodFashion\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\FoodFashion\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index() { $services = Service::latest()->paginate(10); return view('admin.categories.food-fashion.services', compact('services')); }
    public function create() { return view('admin.categories.food-fashion.services_create'); }
    public function store(Request $request) { Service::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.food-fashion.services')->with('success','Created'); }
    public function edit($id) { $service = Service::findOrFail($id); return view('admin.categories.food-fashion.services_edit', compact('service')); }
    public function update(Request $request, $id) { Service::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.food-fashion.services')->with('success','Updated'); }
    public function destroy($id) { Service::findOrFail($id)->delete(); return redirect()->route('admin.food-fashion.services')->with('success','Deleted'); }
}
