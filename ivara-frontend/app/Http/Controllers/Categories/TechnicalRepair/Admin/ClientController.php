<?php

namespace App\Http\Controllers\Categories\TechnicalRepair\Admin;

use App\Http\Controllers\Controller;
use App\Modules\TechnicalRepair\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() { $clients = Client::latest()->paginate(10); return view('admin.categories.technical-repair.clients', compact('clients')); }
    public function create() { return view('admin.categories.technical-repair.clients_create'); }
    public function store(Request $request) { Client::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.technical-repair.clients')->with('success','Created'); }
    public function edit($id) { $client = Client::findOrFail($id); return view('admin.categories.technical-repair.clients_edit', compact('client')); }
    public function update(Request $request, $id) { Client::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.technical-repair.clients')->with('success','Updated'); }
    public function destroy($id) { Client::findOrFail($id)->delete(); return redirect()->route('admin.technical-repair.clients')->with('success','Deleted'); }
}
