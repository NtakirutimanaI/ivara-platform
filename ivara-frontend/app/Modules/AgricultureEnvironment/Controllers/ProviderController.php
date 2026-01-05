<?php

namespace App\Modules\AgricultureEnvironment\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\AgricultureEnvironment\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index() { $providers = Provider::latest()->paginate(10); return view('admin.categories.agriculture-environment.providers', compact('providers')); }
    public function create() { return view('admin.categories.agriculture-environment.providers_create'); }
    public function store(Request $request) { Provider::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.agriculture-environment.providers')->with('success','Created'); }
    public function edit($id) { $provider = Provider::findOrFail($id); return view('admin.categories.agriculture-environment.providers_edit', compact('provider')); }
    public function update(Request $request, $id) { Provider::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.agriculture-environment.providers')->with('success','Updated'); }
    public function destroy($id) { Provider::findOrFail($id)->delete(); return redirect()->route('admin.agriculture-environment.providers')->with('success','Deleted'); }
}
