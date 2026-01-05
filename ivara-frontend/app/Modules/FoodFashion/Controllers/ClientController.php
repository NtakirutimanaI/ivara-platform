<?php

namespace App\Modules\FoodFashion\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\FoodFashion\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() { $clients = Client::latest()->paginate(10); return view('admin.categories.food-fashion.clients', compact('clients')); }
    public function create() { return view('admin.categories.food-fashion.clients_create'); }
    public function store(Request $request) { Client::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.food-fashion.clients')->with('success','Created'); }
    public function edit($id) { $client = Client::findOrFail($id); return view('admin.categories.food-fashion.clients_edit', compact('client')); }
    public function update(Request $request, $id) { Client::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.food-fashion.clients')->with('success','Updated'); }
    public function destroy($id) { Client::findOrFail($id)->delete(); return redirect()->route('admin.food-fashion.clients')->with('success','Deleted'); }
}
