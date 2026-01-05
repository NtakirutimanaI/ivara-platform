<?php

namespace App\Modules\Core\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Repair;
use App\Models\TailorRepair;
use App\Models\CraftRepair;

class SelfRegisterController extends Controller
{
    public function index() {
        return view('admin.self-register.self-register');
    }

    public function accessLink() {
        return view('admin.self-register.access-link');
    }

    public function vehicle(Request $request) {
        $request->validate([
            'registration_number'=>'required|string|unique:vehicles,registration_number',
            'make'=>'required|string',
            'model'=>'required|string',
            'year'=>'nullable|integer',
            'color'=>'nullable|string',
            'vehicle_type'=>'nullable|string'
        ]);
        Vehicle::create([
            'registration_number'=>$request->registration_number,
            'make'=>$request->make,
            'model'=>$request->model,
            'year'=>$request->year,
            'color'=>$request->color,
            'vehicle_type'=>$request->vehicle_type,
            'status'=>'active'
        ]);
        return redirect()->back()->with('success','Vehicle registered successfully!');
    }

    public function device(Request $request){
        $request->validate([
            'device_type'=>'nullable|string',
            'device_name'=>'required|string',
            'serial_number'=>'required|string|unique:repairs,serial_number',
            'brand'=>'required|string',
            'model'=>'required|string',
            'operating_system'=>'nullable|string',
            'device_owner'=>'required|string',
            'contact_number'=>'required|string',
            'problem_description'=>'required|string',
            'warranty_status'=>'required|in:Under Warranty,Out of Warranty',
        ]);
        Repair::create([
            'device_type'=>$request->device_type,
            'device_name'=>$request->device_name,
            'serial_number'=>$request->serial_number,
            'brand'=>$request->brand,
            'model'=>$request->model,
            'operating_system'=>$request->operating_system,
            'device_owner'=>$request->device_owner,
            'contact_number'=>$request->contact_number,
            'problem_description'=>$request->problem_description,
            'warranty_status'=>$request->warranty_status,
            'repair_status'=>'Pending',
            'status'=>'pending'
        ]);
        return redirect()->back()->with('success','Device registered successfully!');
    }

    public function tailor(Request $request){
        $request->validate([
            'customer_name'=>'required|string',
            'customer_contact'=>'nullable|string',
            'item_name'=>'required|string',
            'item_model'=>'nullable|string',
            'repair_details'=>'required|string',
            'price'=>'nullable|numeric',
            'date_received'=>'required|date',
            'expected_completion_date'=>'nullable|date',
            'repair_status'=>'required|in:Pending,In Progress,Completed,Collected'
        ]);
        TailorRepair::create($request->only([
            'customer_name','customer_contact','item_name','item_model','repair_details','price','date_received','expected_completion_date','repair_status'
        ]));
        return redirect()->back()->with('success','Tailor item registered successfully!');
    }

    public function craft(Request $request){
        $request->validate([
            'craftsperson_name'=>'required|string',
            'craft_type'=>'required|string',
            'repair_item'=>'required|string',
            'repair_description'=>'nullable|string',
            'repair_date'=>'required|date',
            'repair_cost'=>'nullable|numeric',
            'status'=>'required|in:Pending,In Progress,Completed',
            'client_name'=>'nullable|string',
            'client_contact'=>'nullable|string',
        ]);
        \App\Models\CraftRepair::create($request->all());
        return redirect()->back()->with('success','Craftsperson repair registered successfully!');
    }
}
