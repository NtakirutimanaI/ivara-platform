<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Service;
use App\Models\User;
use App\Models\Team;

class BookingController extends Controller
{
    /**
     * Display available services for booking
     */
    public function webBookings()
    {
        $services = Service::where('is_active', 1)->get();
        return view('web.bookings', compact('services'));
    }

    /**
     * AJAX: Directly book a service
     */
    public function addAjax($serviceId)
    {
        $user = Auth::user();
        if (!$user) return response()->json(['success' => false, 'message' => 'You must be logged in.']);

        $service = Service::find($serviceId);
        if (!$service) return response()->json(['success' => false, 'message' => 'Service not found.']);

        $client = Client::firstOrCreate(
            ['user_id' => $user->id],
            ['name' => $user->name ?? 'Unknown', 'phone' => $user->phone ?? '']
        );

        $exists = Booking::where('client_id', $client->id)
            ->where('service_id', $service->id)
            ->first();

        if ($exists) return response()->json(['success' => false, 'message' => 'You already booked this service.']);

        Booking::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'Pending'
        ]);

        return response()->json(['success' => true, 'message' => 'Service booked successfully.']);
    }

    /**
     * AJAX: Add service to temporary session bookings
     */
    public function addToSession($serviceId)
    {
        $user = Auth::user();
        if (!$user) return response()->json(['success' => false, 'message' => 'You must be logged in.']);

        $service = Service::find($serviceId);
        if (!$service) return response()->json(['success' => false, 'message' => 'Service not found.']);

        $tempBookings = session()->get('temp_bookings', []);
        if (in_array($service->id, $tempBookings)) {
            return response()->json(['success' => false, 'message' => 'This service is already added!']);
        }

        $tempBookings[] = $service->id;
        session(['temp_bookings' => $tempBookings]);

        return response()->json(['success' => true, 'message' => 'Service added to your bookings!']);
    }

    /**
     * Show temporary bookings for confirmation
     */
    public function confirmBookings()
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login')->with('error', 'You must be logged in.');

        $tempBookings = session()->get('temp_bookings', []);
        $services = Service::whereIn('id', $tempBookings)->get();

        return view('web.confirm_bookings', compact('services'));
    }

    /**
     * Confirm all temporary bookings and save to DB
     */
    public function confirm(Request $request)
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login')->with('error', 'You must be logged in.');

        $tempBookings = session()->get('temp_bookings', []);
        if (empty($tempBookings)) {
            return redirect()->route('bookings.index')->with('error', 'No bookings to confirm.');
        }

        $client = Client::firstOrCreate(
            ['user_id' => $user->id],
            ['name' => $user->name ?? 'Unknown', 'phone' => $user->phone ?? '']
        );

        foreach ($tempBookings as $serviceId) {
            $exists = Booking::where('client_id', $client->id)
                ->where('service_id', $serviceId)
                ->first();
            if (!$exists) {
                Booking::create([
                    'client_id' => $client->id,
                    'service_id' => $serviceId,
                    'status' => 'Confirmed'
                ]);
            }
        }

        session()->forget('temp_bookings');

        return redirect()->route('bookings.index')->with('success', 'All bookings confirmed!');
    }

    /**
     * Show all confirmed bookings for the authenticated user
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) abort(403, 'You must be logged in.');

        $client = Client::firstOrCreate(
            ['user_id' => $user->id],
            ['name' => $user->name ?? 'Unknown', 'phone' => $user->phone ?? '']
        );

        $bookings = Booking::with('service')->where('client_id', $client->id)->get();
        $services = $bookings->map(fn($b) => $b->service);

        return view('web.confirm_bookings', compact('services'));
    }

    /**
     * Admin view of all bookings
     */
    public function adminBooking()
    {
        $bookings = Booking::with('client', 'service')->orderBy('id', 'desc')->get();
        $services = Service::orderBy('name')->paginate(10);

        return view('admin.bookings', compact('bookings', 'services'));
    }

    /**
     * Admin: Confirm booking
     */
    public function adminConfirm($id)
    {
        $booking = Booking::find($id);
        if (!$booking) return response()->json(['success' => false, 'message' => 'Booking not found']);

        $booking->status = 'Confirmed';
        $booking->save();

        return response()->json(['success' => true, 'message' => 'Booking confirmed!']);
    }

    /**
     * Admin: Edit booking status
     */
    public function adminEdit(Request $request, $id)
    {
        $booking = Booking::find($id);
        if (!$booking) return response()->json(['success' => false, 'message' => 'Booking not found']);

        $booking->status = $request->status ?? $booking->status;
        $booking->save();

        return response()->json(['success' => true, 'message' => 'Booking updated!']);
    }

    /**
     * Admin: Delete booking
     */
    public function adminDelete($id)
    {
        $booking = Booking::find($id);
        if (!$booking) return response()->json(['success' => false, 'message' => 'Booking not found']);

        $booking->delete();
        return response()->json(['success' => true, 'message' => 'Booking deleted!']);
    }

    /**
     * Client: Edit booking
     */
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $services = Service::all();

        return view('bookings.edit', compact('booking', 'services'));
    }

    /**
     * Client: Update booking
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'status' => 'required|string|in:Pending,Confirmed,Cancelled',
        ]);

        $booking->service_id = $request->service_id;
        $booking->status = $request->status;
        $booking->save();

        return redirect()->route('bookings.confirm')->with('success', 'Booking updated successfully.');
    }

    /**
     * Client: Delete booking
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('bookings.confirm')->with('success', 'Booking deleted successfully.');
    }

    /**
     * Update service details
     */
    public function updateService(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Service updated successfully!');
    }

    /**
     * Supervisor: View bookings and assign technicians/teams
     */
    public function supervisorBookings()
    {
        $bookings = Booking::with(['client', 'service', 'technician'])->get();
        $technicians = User::where('role', 'Technician')->get();
        $teams = Team::all();

        return view('supervisor.view_bookings', compact('bookings', 'technicians', 'teams'));
    }

    /**
     * Supervisor: Assign technician or team
     */
    public function assignTechnician(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        [$type, $assignedId] = explode('-', $request->assigned_id);

        $booking->assigned_type = $type;
        $booking->assigned_id = $assignedId;
        $booking->assigned_name = $type === 'technician'
            ? User::find($assignedId)->name
            : Team::find($assignedId)->full_name;

        $booking->status = 'Assigned';
        $booking->save();

        return response()->json([
            'success' => true,
            'assigned_name' => $booking->assigned_name,
            'message' => 'Assigned successfully!'
        ]);
    }

    /**
     * Delete booking (alternative)
     */
    public function deleteBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }
}
