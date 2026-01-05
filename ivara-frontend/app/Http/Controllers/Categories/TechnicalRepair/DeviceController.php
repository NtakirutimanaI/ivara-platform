<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Client;
use App\Models\Activity;
use App\Events\ActivityCreated;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    // -------------------- Device Methods --------------------

    /**
     * Display all devices.
     */
    public function index()
    {
        $devices = Device::all();
        return view('admin.device', compact('devices'));
    }

    /**
     * Store a new device and broadcast activity.
     */
    public function store(Request $request)
    {
        // Validate input (merged simple fields + extended fields)
        $request->validate([
            'client_id'              => 'required|exists:clients,id',
            'brand'                  => 'required|string|max:255',
            'model'                  => 'required|string|max:255',
            'serial_number'          => 'required|string|max:255|unique:devices,serial_number',
            'imei_1'                 => 'nullable|string|max:255',
            'imei_2'                 => 'nullable|string|max:255',
            'imei_3_or_mac_or_plate' => 'nullable|string|max:255',
            'type'                   => 'nullable|string|max:255',
            'os'                     => 'nullable|string|max:255',
            'status'                 => 'nullable|in:active,inactive,under_repair,lost,stolen,repair_approved',
            'purchase_date'          => 'nullable|date',
            'warranty_expiry'        => 'nullable|date',
            'location'               => 'nullable|string|max:255',
            'notes'                  => 'nullable|string|max:500',
        ]);

        // Create the device
        $device = Device::create($request->only([
            'client_id', 'brand', 'model', 'serial_number', 'imei_1', 'imei_2', 'imei_3_or_mac_or_plate',
            'type', 'os', 'status', 'purchase_date', 'warranty_expiry', 'location', 'notes'
        ]));

        // Log activity
        $activity = Activity::create([
            'message' => 'New device added: ' . $device->brand . ' ' . $device->model,
            'icon'    => 'fas fa-mobile-alt',
        ]);

        // Broadcast to others (optional real-time update)
        broadcast(new ActivityCreated($activity))->toOthers();

        return response()->json([
            'success' => true,
            'device_id' => $device->id
        ]);
    }

    /**
     * Show a single device (optional)
     */
    public function show(Device $device)
    {
        return response()->json($device);
    }

    /**
     * Update device information
     */
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'brand'                  => 'required|string|max:255',
            'model'                  => 'required|string|max:255',
            'serial_number'          => 'required|string|max:255|unique:devices,serial_number,' . $device->id,
            'imei_1'                 => 'nullable|string|max:255',
            'imei_2'                 => 'nullable|string|max:255',
            'imei_3_or_mac_or_plate' => 'nullable|string|max:255',
            'type'                   => 'nullable|string|max:255',
            'os'                     => 'nullable|string|max:255',
            'status'                 => 'nullable|in:active,inactive,under_repair,lost,stolen,repair_approved',
            'purchase_date'          => 'nullable|date',
            'warranty_expiry'        => 'nullable|date',
            'location'               => 'nullable|string|max:255',
            'notes'                  => 'nullable|string|max:500',
            'client_id'              => 'nullable|exists:clients,id',
        ]);

        $device->update($request->only([
            'client_id', 'brand', 'model', 'serial_number', 'imei_1', 'imei_2', 'imei_3_or_mac_or_plate',
            'type', 'os', 'status', 'purchase_date', 'warranty_expiry', 'location', 'notes'
        ]));

        // Log activity
        $activity = Activity::create([
            'message' => 'Device updated: ' . $device->brand . ' ' . $device->model,
            'icon'    => 'fas fa-edit',
        ]);

        broadcast(new ActivityCreated($activity))->toOthers();

        return response()->json([
            'success' => true,
            'device_id' => $device->id
        ]);
    }

    /**
     * Delete a device
     */
    public function destroy(Device $device)
    {
        $deviceName = $device->brand . ' ' . $device->model;
        $device->delete();

        // Log activity
        $activity = Activity::create([
            'message' => 'Device deleted: ' . $deviceName,
            'icon'    => 'fas fa-trash',
        ]);

        broadcast(new ActivityCreated($activity))->toOthers();

        return response()->json([
            'success' => true,
            'message' => 'Device deleted successfully.'
        ]);
    }


public function edit(Device $device)  // <--- type-hint Device
{
    $clients = Client::all();
    return view('admin.edit_device', compact('device', 'clients'));
}


}
