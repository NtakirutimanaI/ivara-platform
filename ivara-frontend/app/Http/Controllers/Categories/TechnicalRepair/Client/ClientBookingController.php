<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientBookingController extends Controller
{
    /**
     * Show booking form with available services and current bookings
     */
    public function showServices(Request $request)
    {
        $services = Service::all();
        $client = Auth::user()->client ?? null;

        $bookings = $client
            ? Booking::with('service')
                ->where('client_id', $client->id)
                ->when($request->status, fn($q) => $q->where('status', $request->status))
                ->when($request->from_date && $request->to_date, fn($q) => $q->whereBetween('preferred_date', [$request->from_date, $request->to_date]))
                ->when($request->search, fn($q) => $q->whereHas('service', fn($s) => $s->where('name', 'like', '%'.$request->search.'%'))
                    ->orWhere('assigned_name', 'like', '%'.$request->search.'%'))
                ->orderBy('preferred_date', 'desc')
                ->paginate(10)
            : new LengthAwarePaginator([], 0, 10);

        return view('client.bookings', compact('services', 'bookings'));
    }

    /**
     * Add service to session via AJAX
     */
    public function addServiceToSession($serviceId)
    {
        $service = Service::find($serviceId);
        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $bookings = Session::get('bookings', []);

        if (!in_array($serviceId, $bookings)) {
            $bookings[] = $serviceId;
            Session::put('bookings', $bookings);
        }

        return response()->json(['message' => 'Service added to your bookings']);
    }

    /**
     * Show confirmation page for selected services
     */
    public function confirmBookings()
    {
        $serviceIds = Session::get('bookings', []);
        $services = Service::whereIn('id', $serviceIds)->get();

        $technicians = User::role('technician')->get();
        $mechanicians = User::role('mechanician')->get();
        $craftspersons = User::role('craftsperson')->get();

        return view('client.confirm-bookings', compact('services', 'technicians', 'mechanicians', 'craftspersons'));
    }

    /**
     * Store confirmed bookings
     */
    public function storeBookings(Request $request)
    {
        $request->validate([
            'assigned_user_id' => 'required|exists:users,id',
            'scheduled_at' => 'required|date|after:now',
            'notes' => 'nullable|string|max:500',
        ]);

        $client = Auth::user()->client ?? null;
        if (!$client) {
            return redirect()->back()->with('error', 'Client not found.');
        }

        $serviceIds = Session::get('bookings', []);
        if (empty($serviceIds)) {
            return redirect()->back()->with('error', 'No services selected.');
        }

        foreach ($serviceIds as $serviceId) {
            $conflict = Booking::where('assigned_user_id', $request->assigned_user_id)
                ->where('preferred_date', $request->scheduled_at)
                ->exists();

            if ($conflict) {
                return redirect()->back()->with('error', 'Selected staff is already booked at this time.');
            }

            Booking::create([
                'client_id' => $client->id,
                'service_id' => $serviceId,
                'assigned_user_id' => $request->assigned_user_id,
                'assigned_name' => User::find($request->assigned_user_id)->name ?? null,
                'preferred_date' => $request->scheduled_at,
                'status' => 'Pending',
                'notes' => $request->notes,
            ]);

            Notification::create([
                'client_id' => $client->id,
                'user_id' => $request->assigned_user_id,
                'type' => 'Booking',
                'message' => "New booking scheduled for service ID: $serviceId at {$request->scheduled_at}",
            ]);
        }

        Session::forget('bookings');

        return redirect()->route('client.bookings.history')->with('success', 'Booking(s) confirmed successfully!');
    }

    /**
     * Display client booking history with filters and search
     */
    public function history(Request $request)
    {
        $client = Auth::user()->client ?? null;
        if (!$client) {
            return redirect()->back()->with('error', 'Client not found.');
        }

        $bookings = Booking::with('service')
            ->where('client_id', $client->id)
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->from_date && $request->to_date, fn($q) => $q->whereBetween('preferred_date', [$request->from_date, $request->to_date]))
            ->when($request->search, fn($q) => $q->whereHas('service', fn($s) => $s->where('name', 'like', '%'.$request->search.'%'))
                ->orWhere('assigned_name', 'like', '%'.$request->search.'%'))
            ->orderBy('preferred_date', 'desc')
            ->paginate(10);

        return view('client.bookings-history', compact('bookings'));
    }

    /**
     * Shortcut method for client bookings (history view)
     */
    public function bookings()
    {
        $client = auth()->user()->client;

        $bookings = $client
            ? Booking::where('client_id', $client->id)
                ->orderBy('preferred_date', 'desc')
                ->paginate(10)
            : new LengthAwarePaginator([], 0, 10);

        return view('client.bookings-history', compact('bookings'));
    }

    /**
     * Show booking details (for modal AJAX)
     */
    public function showBookingDetails($id)
    {
        $client = Auth::user()->client ?? null;
        $booking = Booking::with('service')->where('client_id', $client->id)->findOrFail($id);

        return view('client.booking-details', compact('booking'));
    }

    /**
     * Cancel a booking
     */
    public function cancelBooking($id)
    {
        $client = Auth::user()->client ?? null;
        $booking = Booking::where('client_id', $client->id)->findOrFail($id);

        if (!in_array($booking->status, ['Pending', 'Confirmed'])) {
            return redirect()->back()->with('error', 'Only pending or confirmed bookings can be cancelled.');
        }

        $booking->status = 'Cancelled';
        $booking->save();

        Notification::create([
            'client_id' => $client->id,
            'user_id' => $booking->assigned_user_id,
            'type' => 'Booking',
            'message' => "Booking ID {$booking->id} has been cancelled by the client.",
        ]);

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Reschedule a booking
     */
    public function rescheduleBooking(Request $request, $id)
    {
        $client = Auth::user()->client ?? null;
        $booking = Booking::where('client_id', $client->id)->findOrFail($id);

        $request->validate([
            'new_date' => 'required|date|after:now',
        ]);

        $conflict = Booking::where('assigned_user_id', $booking->assigned_user_id)
            ->where('preferred_date', $request->new_date)
            ->exists();

        if ($conflict) {
            return redirect()->back()->with('error', 'Selected staff is already booked at this time.');
        }

        $booking->preferred_date = $request->new_date;
        $booking->status = 'Pending';
        $booking->save();

        Notification::create([
            'client_id' => $client->id,
            'user_id' => $booking->assigned_user_id,
            'type' => 'Booking',
            'message' => "Booking ID {$booking->id} has been rescheduled by the client to {$request->new_date}.",
        ]);

        return redirect()->back()->with('success', 'Booking rescheduled successfully.');
    }

    /**
     * Submit feedback for a completed booking
     */
    public function submitFeedback(Request $request, $id)
    {
        $client = Auth::user()->client ?? null;
        $booking = Booking::where('client_id', $client->id)->findOrFail($id);

        if ($booking->status != 'Completed') {
            return redirect()->back()->with('error', 'Feedback can only be submitted for completed bookings.');
        }

        $request->validate([
            'feedback' => 'required|string|max:500',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $booking->feedback = $request->feedback;
        $booking->rating = $request->rating;
        $booking->save();

        Notification::create([
            'client_id' => $client->id,
            'user_id' => $booking->assigned_user_id,
            'type' => 'Feedback',
            'message' => "Client submitted feedback for booking ID {$booking->id}.",
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully.');
    }
}
