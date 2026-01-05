<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Mediator;
use App\Models\User;
use App\Models\Client;
use App\Models\Transaction;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class MediatorConnectionController extends Controller
{
  public function connections(Request $request)
{
    // Get the authenticated mediator
    $mediator = Mediator::where('user_id', auth()->id())->first();

    if (!$mediator) {
        return redirect()->back()->with('error', 'Mediator not found');
    }

    // Step 1: Get available locations from technicians
    $locations = User::where('role', 'technician')
        ->distinct()
        ->pluck('location');

    $technicians = collect();
    $services = collect();
    $clients = collect();

    // Step 2: If location is selected, fetch technicians
    if ($request->location) {
        $technicians = User::where('role', 'technician')
            ->where('location', $request->location)
            ->get();
    }

    // Step 3: If technician is selected, fetch services
    if ($request->technician) {
        $services = \App\Models\Service::with(['client', 'technician'])
            ->where('technician_id', $request->technician)
            ->get();

        // Step 4: Get clients associated with the fetched services
        $clients = $services->pluck('client')->filter(); // remove nulls if any
    }

    // Pass all variables to the view
    return view('mediator.connections', compact('locations', 'technicians', 'services', 'clients'));
}


public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'national_id' => 'nullable|string|max:255',
        'gender' => 'nullable|in:Male,Female,Other',
        'date_of_birth' => 'nullable|date',
        'notes' => 'nullable|string',
    ]);

    $client = new \App\Models\Client();
    $client->mediator_id = auth()->id(); // current mediator
    $client->fill($request->all());
    $client->status = 'active';
    $client->save();

    return response()->json([
        'success' => true,
        'client' => $client
    ]);
     return view('mediator.connections', compact('locations', 'technicians', 'services', 'clients'));
}

public function processPayment(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'method' => 'required|string',
            'transaction_id' => 'required|string',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        $booking->payment_method = $request->method;
        $booking->transaction_id = $request->transaction_id;
        $booking->status = 'paid';
        $booking->save();

        return redirect()->back()->with('success', 'Payment processed successfully!');
    }
}
