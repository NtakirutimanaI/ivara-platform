<?php

namespace App\Http\Controllers\Categories\TechnicalRepair\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technician;
use App\Models\Client;

class TechnicianController extends Controller
{
    public function index()
    {
        return view('technician.index'); 
    }

    public function registerDevice()
    {
        $clients = Client::all();
        return view('technician.register_device', compact('clients'));
    }

    public function storeDevice(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'device_type' => 'required|string|max:50',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'serial_number' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:50',
            'condition' => 'nullable|string|max:50',
            'problem_description' => 'required|string',
            'priority' => 'required|in:normal,high,urgent',
            'estimated_cost' => 'nullable|numeric|min:0',
            'estimated_days' => 'nullable|integer|min:1',
            'accessories' => 'nullable|string|max:255',
            'device_password' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        // For now, just redirect with success message
        // In production, you would save to a devices/repairs table
        return redirect()->route('technician.index')
            ->with('success', 'Device registered successfully! ' . $validated['brand'] . ' ' . $validated['model'] . ' has been added to the repair queue.');
    }

    public function jobs()
    {
        return view('technician.jobs.index');
    }

    public function workOrders()
    {
        return view('technician.work_orders.index');
    }

    public function inventory()
    {
        return view('technician.inventory.index');
    }

    public function bookings()
    {
        return view('technician.bookings.index');
    }

    public function schedule()
    {
        return view('technician.schedule.index');
    }

    public function support()
    {
        return view('technician.support.index');
    }

    public function meetings()
    {
        return view('technician.meetings');
    }

    public function eLearning()
    {
        return view('technician.e-learning');
    }

    public function connections()
    {
        return view('technician.connections');
    }
}
