<?php

namespace App\Modules\TransportTravel\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TransportTravel\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index() { $vehicles = Vehicle::latest()->paginate(10); return view('admin.categories.transport-travel.vehicles', compact('vehicles')); }
    public function create() { return view('admin.categories.transport-travel.vehicles_create'); }
    public function store(Request $request) { Vehicle::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.transport-travel.vehicles')->with('success','Created'); }
    public function edit($id) { $vehicle = Vehicle::findOrFail($id); return view('admin.categories.transport-travel.vehicles_edit', compact('vehicle')); }
    public function update(Request $request, $id) { Vehicle::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.transport-travel.vehicles')->with('success','Updated'); }
    public function destroy($id) { Vehicle::findOrFail($id)->delete(); return redirect()->route('admin.transport-travel.vehicles')->with('success','Deleted'); }
}
