<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientDeviceController extends Controller
{
    /**
     * Display all devices for the logged-in client.
     */
    public function myDevicesClient()
    {
        $devices = Device::where('user_id', Auth::id())->get();
        return view('client.myDevices', compact('devices'));
    }

    /**
     * Store a new device for the logged-in client.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:devices,serial_number',
            'type' => 'required|string|max:255',
            'os' => 'nullable|string|max:255',
            'status' => 'required|in:pending,active,inactive,repair',
            'imei_1' => 'nullable|string|max:255',
            'imei_2' => 'nullable|string|max:255',
            'imei_3_or_mac_or_plate' => 'nullable|string|max:255',
            'purchase_date' => 'nullable|date',
            'warranty_expiry' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        Device::create($validated);

        return redirect()->route('client.myDevices')->with('success', 'Device added successfully!');
    }

    /**
     * Update an existing device.
     */
    public function update(Request $request, Device $device)
    {
        // Ensure the device belongs to the logged-in client
        if ($device->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:devices,serial_number,' . $device->id,
            'type' => 'required|string|max:255',
            'os' => 'nullable|string|max:255',
            'status' => 'required|in:pending,active,inactive,repair',
            'imei_1' => 'nullable|string|max:255',
            'imei_2' => 'nullable|string|max:255',
            'imei_3_or_mac_or_plate' => 'nullable|string|max:255',
            'purchase_date' => 'nullable|date',
            'warranty_expiry' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $device->update($validated);

        return redirect()->route('client.myDevices')->with('success', 'Device updated successfully.');
    }

    /**
     * Delete a device.
     */
    public function destroy(Device $device)
    {
        // Ensure the device belongs to the logged-in client
        if ($device->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $device->delete();

        return redirect()->route('client.myDevices')->with('success', 'Device deleted successfully.');
    }
}
