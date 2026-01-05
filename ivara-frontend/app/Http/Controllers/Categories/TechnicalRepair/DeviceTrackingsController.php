<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Client;
use Illuminate\Http\Request;

class DeviceTrackingsController extends Controller
{
    // Show devices
    public function indexPage()
    {
        $devices = Device::with('user', 'client')->get();
        return view('admin.devices.tracking', compact('devices'));
    }

    public function showStep($step)
    {
        return view("tracking.step{$step}");
    }
    // Store device
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:devices,serial_number',
            'type' => 'required|string|max:255',
        ]);

        // Check duplicate
        $existing = Device::where('serial_number', $request->serial_number)->first();
        if ($existing) {
            $owner = $existing->client ? $existing->client->name : 'No Owner';
            return redirect()->back()->with('error', "Device already registered. Owner: {$owner}");
        }

        $device = Device::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'type' => $request->type,
            'status' => 'active',
            'user_id'       => auth()->id(),
        ]);

        // redirect with flag to open client modal
        return redirect()->route('admin.devices.index')
            ->with('success', 'Device registered successfully. Now add owner.')
            ->with('openClientModal', true)
            ->with('device_id', $device->id);
    }

    // Store client as owner
    public function storeClient(Request $request)
    {
        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'national_id' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        $client = Client::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'national_id' => $request->national_id,
            'city' => $request->city,
            'country' => $request->country ?? 'Rwanda',
            'status' => 'active',
        ]);

        // assign client to device
        $device = Device::findOrFail($request->device_id);
        $device->client_id = $client->id;
        $device->save();

        return redirect()->route('admin.devices.index')->with('success', 'Device owner registered successfully.');
    }

    // Track device
    public function track($id)
    {
        $device = Device::findOrFail($id);

        // Example dummy response - integrate GPS/IP later
        $location = $device->location ?? 'Unknown';
        return response()->json([
            'device_id' => $device->id,
            'brand' => $device->brand,
            'model' => $device->model,
            'last_known_location' => $location,
            'last_seen_at' => $device->last_seen_at,
        ]);
    }

    // Report stolen
    public function reportStolen($id)
    {
        $device = Device::findOrFail($id);
        $device->status = 'stolen';
        $device->save();

        return redirect()->back()->with('error', "Device ID {$device->id} has been marked as STOLEN.");
    }

    // Update status
    public function updateStatus(Request $request, $id)
    {
        $device = Device::findOrFail($id);
        $device->status = $request->status;
        $device->save();

        return redirect()->back()->with('success', "Device status updated to {$device->status}.");
    }
}
