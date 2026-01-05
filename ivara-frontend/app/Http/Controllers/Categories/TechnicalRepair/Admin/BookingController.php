<?php

namespace App\Modules\TechnicalRepair\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TechnicalRepair\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index() { $bookings = Booking::latest()->paginate(10); return view('admin.categories.technical-repair.bookings', compact('bookings')); }
    public function create() { return view('admin.categories.technical-repair.bookings_create'); }
    public function store(Request $request) { Booking::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.technical-repair.bookings')->with('success','Created'); }
    public function edit($id) { $booking = Booking::findOrFail($id); return view('admin.categories.technical-repair.bookings_edit', compact('booking')); }
    public function update(Request $request, $id) { Booking::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.technical-repair.bookings')->with('success','Updated'); }
    public function destroy($id) { Booking::findOrFail($id)->delete(); return redirect()->route('admin.technical-repair.bookings')->with('success','Deleted'); }
}
