<?php
namespace App\Modules\TechnicalRepair\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Client; // Owner
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class TechnicianRegisterController extends Controller
{
    // Show the device registration page
   public function registerDevice()
{
    $devices = Device::where('user_id', Auth::id())->latest()->get();
    return view('technician.register-device', compact('devices'));
}


    // Store a new device
    public function storeDevice(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:devices,serial_number',
            'imei_1' => 'nullable|string|max:255',
            'type' => 'required|string',
            'os' => 'nullable|string|max:255',
            'client_id' => 'required|integer',
            'location' => 'nullable|string|max:255',
        ]);

        $device = Device::create([
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'serial_number' => $validated['serial_number'],
            'imei_1' => $validated['imei_1'] ?? null,
            'type' => $validated['type'],
            'os' => $validated['os'] ?? null,
            'client_id' => $validated['client_id'],
            'location' => $validated['location'] ?? null,
            'status' => 'active',
             'user_id'       => Auth::id(),
        ]);

        // Trigger the owner modal after device registration
        Session::flash('success', 'Device registered successfully.');
        Session::flash('show_owner_modal', true); // will open Owner Modal

        return redirect()->back();
    }

    // Update an existing device
    public function updateDevice(Request $request, $id)
    {
        $device = Device::findOrFail($id);

        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:devices,serial_number,' . $device->id,
            'imei_1' => 'nullable|string|max:255',
            'type' => 'required|string',
            'os' => 'nullable|string|max:255',
            'client_id' => 'required|integer',
            'location' => 'nullable|string|max:255',
        ]);

        $device->update($validated);

        Session::flash('success', 'Device updated successfully.');
        return redirect()->back();
    }

    // Delete a device
    public function destroyDevice($id)
    {
        $device = Device::findOrFail($id);
        $device->delete();

        Session::flash('success', 'Device deleted successfully.');
        return redirect()->back();
    }

    // Store a new owner/client
    public function storeOwner(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'national_id' => 'nullable|string|max:50',
            'gender' => 'nullable|string|max:10',
            'date_of_birth' => 'nullable|date',
            'notes' => 'nullable|string|max:500',
        ]);

        Client::create($validated);

        Session::flash('success', 'Owner (Client) added successfully.');
        return redirect()->back();
    }
}
