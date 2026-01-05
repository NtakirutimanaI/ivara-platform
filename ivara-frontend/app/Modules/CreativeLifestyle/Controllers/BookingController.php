<?php

namespace App\Modules\CreativeLifestyle\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CreativeLifestyle\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()->paginate(10);
        return view('admin.categories.creative-lifestyle.bookings', compact('bookings'));
    }

    public function create()
    {
        return view('admin.categories.creative-lifestyle.bookings_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        Booking::create($validated);

        return redirect()->route('admin.creative-lifestyle.bookings')
            ->with('success', 'Booking created successfully.');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.categories.creative-lifestyle.bookings_edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        $booking->update($validated);

        return redirect()->route('admin.creative-lifestyle.bookings')
            ->with('success', 'Booking updated successfully.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.creative-lifestyle.bookings')
            ->with('success', 'Booking deleted successfully.');
    }
}
