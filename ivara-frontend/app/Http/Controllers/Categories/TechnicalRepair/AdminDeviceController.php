<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use App\Models\Device;
use App\Models\Client;
use Illuminate\Http\Request;

class AdminDeviceController extends Controller
{
    /**
     * Display a listing of devices.
     */
    public function index(Request $request)
    {
        $pageSize = $request->get('pageSize', 10); // default 10
        $devices = Device::with('user', 'client')->paginate($pageSize);
        return view('admin.devices.index', compact('devices'));
    }

    /**
     * Store a newly created device.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:devices',
            'type' => 'nullable|string|max:255',
            'imei_1' => 'nullable|string|max:255',
            'imei_2' => 'nullable|string|max:255',
            'imei_3_or_mac_or_plate' => 'nullable|string|max:255',
            'os' => 'nullable|string|max:255',
            'status' => 'required|string|in:pending,active,inactive,repair,repaired',
            'purchase_date' => 'nullable|date',
            'warranty_expiry' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $device = Device::create($validated);

        return redirect()->route('admin.devices.index')
            ->with('success', 'Device registered successfully!')
            ->with('device_saved_id', $device->id); // triggers client modal
    }

    /**
     * Show a single device (for View modal and Edit modal JSON)
     */
    public function show($id)
    {
        $device = Device::with('user', 'client')->findOrFail($id);
        return response()->json($device);
    }

    public function edit($id)
{
    $device = Device::findOrFail($id);
    return response()->json($device);
}


    /**
     * Update an existing device (Edit modal).
     */
    public function update(Request $request, $id)
    {
        $device = Device::findOrFail($id);

        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:devices,serial_number,' . $device->id,
            'type' => 'nullable|string|max:255',
            'imei_1' => 'nullable|string|max:255',
            'imei_2' => 'nullable|string|max:255',
            'imei_3_or_mac_or_plate' => 'nullable|string|max:255',
            'os' => 'nullable|string|max:255',
            'status' => 'required|string|in:pending,active,inactive,repair,repaired',
            'purchase_date' => 'nullable|date',
            'warranty_expiry' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $device->update($validated);

        return redirect()->route('admin.devices.index')
            ->with('success', 'Device updated successfully!');
    }

    /**
     * Delete a device.
     */
    public function destroy($id)
    {
        $device = Device::findOrFail($id);
        $device->delete();

        return redirect()->route('admin.devices.index')
            ->with('success', 'Device deleted successfully!');
    }

    /**
     * Change device status only.
     */
    public function changeStatus(Request $request, $id)
    {
        $device = Device::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,active,inactive,repair,repaired',
        ]);

        $device->status = $validated['status'];
        $device->save();

        return redirect()->route('admin.devices.index')
            ->with('success', 'Device status updated!');
    }

    /**
     * Store client (owner of device)
     */
    public function storeClient(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
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

        Client::create($validated);

        return redirect()->route('admin.devices.index')
            ->with('success', 'Client recorded successfully!');
    }
}
