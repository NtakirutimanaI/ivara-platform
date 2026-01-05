<?php

namespace App\Modules\TransportTravel\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TransportTravel\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() { $payments = Payment::latest()->paginate(10); return view('admin.categories.transport-travel.payments', compact('payments')); }
    public function create() { return view('admin.categories.transport-travel.payments_create'); }
    public function store(Request $request) { Payment::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.transport-travel.payments')->with('success','Created'); }
    public function edit($id) { $payment = Payment::findOrFail($id); return view('admin.categories.transport-travel.payments_edit', compact('payment')); }
    public function update(Request $request, $id) { Payment::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.transport-travel.payments')->with('success','Updated'); }
    public function destroy($id) { Payment::findOrFail($id)->delete(); return redirect()->route('admin.transport-travel.payments')->with('success','Deleted'); }
}
