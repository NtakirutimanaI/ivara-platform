<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;
use App\Models\User;

class ManagerBookingController extends Controller
{
    public function viewBooking()
    {
        $bookings = Booking::with('client', 'service')->orderBy('id', 'desc')->paginate(10);
        $users = User::all();
        $clients = User::where('role', 'client')->get();
        $services = Service::all();
        $technicians = User::where('role', 'technician')->get();

        return view('manager.view_booking', compact('bookings', 'users', 'clients', 'technicians', 'services'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'client_id'      => 'required|exists:users,id',
            'service_id'     => 'required|exists:services,id',
            'preferred_date' => 'nullable|date',
            'status'         => 'required|in:Pending,Confirmed,Cancelled',
            'notes'          => 'nullable|string',
            'price'          => 'nullable|numeric',
            'duration'       => 'nullable|string',
        ]);

        Booking::create($request->all());
        return redirect()->back()->with('success', 'Booking created successfully.');
    }

    public function updateBooking(Request $request, $id)
    {
        $request->validate([
            'preferred_date' => 'nullable|date',
            'status'         => 'required|in:Pending,Confirmed,Cancelled',
            'notes'          => 'nullable|string',
            'price'          => 'nullable|numeric',
            'duration'       => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($request->all());

        return redirect()->back()->with('success', 'Booking updated successfully.');
    }

    public function deleteBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'price'          => 'nullable|numeric',
            'duration'       => 'nullable|string|max:255',
            'available_time' => 'nullable|string|max:255',
            'is_active'      => 'required|boolean',
            'category'       => 'nullable|string|max:255',
            'created_by'     => 'nullable|exists:users,id',
        ]);

        Service::create($request->all());
        return redirect()->back()->with('success', 'Service created successfully.');
    }

    public function assignBooking(Request $request)
    {
        $request->validate([
            'booking_id'    => 'required|exists:bookings,id',
            'technician_id' => 'required|exists:users,id',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        $booking->technician_id = $request->technician_id;
        $booking->status = 'Assigned'; // Make sure 'Assigned' is allowed in DB
        $booking->save();

        return back()->with('success', 'Booking assigned successfully.');
    }
}
