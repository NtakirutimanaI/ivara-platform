<?php

namespace App\Modules\TransportTravel\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TransportTravel\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() { $clients = Client::latest()->paginate(10); return view('admin.categories.transport-travel.clients', compact('clients')); }
    public function create() { return view('admin.categories.transport-travel.clients_create'); }
    public function store(Request $request) { Client::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.transport-travel.clients')->with('success','Created'); }
    public function edit($id) { $client = Client::findOrFail($id); return view('admin.categories.transport-travel.clients_edit', compact('client')); }
    public function update(Request $request, $id) { Client::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.transport-travel.clients')->with('success','Updated'); }
    public function destroy($id) { Client::findOrFail($id)->delete(); return redirect()->route('admin.transport-travel.clients')->with('success','Deleted'); }
}
