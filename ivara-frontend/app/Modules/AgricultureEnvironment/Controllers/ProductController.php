<?php

namespace App\Modules\AgricultureEnvironment\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\AgricultureEnvironment\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() { $products = Product::latest()->paginate(10); return view('admin.categories.agriculture-environment.products', compact('products')); }
    public function create() { return view('admin.categories.agriculture-environment.products_create'); }
    public function store(Request $request) { Product::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.agriculture-environment.products')->with('success','Created'); }
    public function edit($id) { $product = Product::findOrFail($id); return view('admin.categories.agriculture-environment.products_edit', compact('product')); }
    public function update(Request $request, $id) { Product::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.agriculture-environment.products')->with('success','Updated'); }
    public function destroy($id) { Product::findOrFail($id)->delete(); return redirect()->route('admin.agriculture-environment.products')->with('success','Deleted'); }
}
