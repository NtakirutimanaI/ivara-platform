<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use App\Models\Service;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display all services and bookings
     */
    public function index()
    {
        // Get all services
        $services = Service::all();

        // Get all bookings
        $bookings = Booking::with('service', 'client')->get();

        // Extract services from bookings for Blade compatibility
        $bookedServices = $bookings->map(function ($booking) {
            return $booking->service;
        });

        return view('admin.settings', compact('services', 'bookings', 'bookedServices'));
    }

    /**
     * Store a new service
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'duration' => 'nullable|string',
        'available_time' => 'nullable|string',
        'is_active' => 'required|boolean',
        'category' => 'nullable|string',
    ]);

    $service = Service::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Service created successfully!',
        'service' => $service
    ]);
}


    /**
     * Update an existing service
     */
    public function update(Request $request, Service $service)
    {
        $service->update($request->all());
        return back()->with('success', 'Service updated successfully!');
    }

    /**
     * Delete a service
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Service deleted successfully!');
    }

    
}
