<?php

namespace App\Modules\AgricultureEnvironment\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\AgricultureEnvironment\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() { $clients = Client::latest()->paginate(10); return view('admin.categories.agriculture-environment.clients', compact('clients')); }
    public function create() { return view('admin.categories.agriculture-environment.clients_create'); }
    public function store(Request $request) { Client::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.agriculture-environment.clients')->with('success','Created'); }
    public function edit($id) { $client = Client::findOrFail($id); return view('admin.categories.agriculture-environment.clients_edit', compact('client')); }
    public function update(Request $request, $id) { Client::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.agriculture-environment.clients')->with('success','Updated'); }
    public function destroy($id) { Client::findOrFail($id)->delete(); return redirect()->route('admin.agriculture-environment.clients')->with('success','Deleted'); }
}
