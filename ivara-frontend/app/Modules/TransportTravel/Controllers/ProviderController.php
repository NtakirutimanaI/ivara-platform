<?php

namespace App\Modules\TransportTravel\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TransportTravel\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index() { $providers = Provider::latest()->paginate(10); return view('admin.categories.transport-travel.providers', compact('providers')); }
    public function create() { return view('admin.categories.transport-travel.providers_create'); }
    public function store(Request $request) { Provider::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.transport-travel.providers')->with('success','Created'); }
    public function edit($id) { $provider = Provider::findOrFail($id); return view('admin.categories.transport-travel.providers_edit', compact('provider')); }
    public function update(Request $request, $id) { Provider::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.transport-travel.providers')->with('success','Updated'); }
    public function destroy($id) { Provider::findOrFail($id)->delete(); return redirect()->route('admin.transport-travel.providers')->with('success','Deleted'); }
}
