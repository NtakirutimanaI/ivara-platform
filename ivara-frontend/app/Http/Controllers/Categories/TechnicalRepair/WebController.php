<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Device;
use App\Models\Technician;
use App\Models\Activity;
use App\Events\ActivityCreated;       

class WebController extends Controller
{
    // Show the registration form step, defaults to step 1
    public function registerDevice(Request $request)
    {
        $step = (int) $request->query('step', 1);
        $client_id = $request->query('client_id');
        $device_id = $request->query('device_id');

        return view('web.register_device', compact('step', 'client_id', 'device_id'));
    }

    // Store client, then redirect to device registration (step 2)
    public function storeClient(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'email'         => 'nullable|email|max:255',
            'address'       => 'nullable|string|max:255',
            'city'          => 'nullable|string|max:100',
            'country'       => 'nullable|string|max:100',
            'national_id'   => 'nullable|string|max:100',
            'gender'        => 'nullable|string|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'notes'         => 'nullable|string',
        ]);

        $client = Client::create($validated);

        // Broadcast activity
        $activity = Activity::create([
            'message' => 'New client registered: ' . $client->name,
            'icon'    => 'fas fa-user',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->route('web.register_device', ['step' => 2, 'client_id' => $client->id])
                         ->with('success', 'Client saved successfully. Now register device.');
    }

    // Store device, then redirect to technician registration (step 3)
    public function storeDevice(Request $request)
    {
        $validated = $request->validate([
            'client_id'             => 'required|exists:clients,id',
            'brand'                 => 'required|string|max:255',
            'model'                 => 'required|string|max:255',
            'serial_number'         => 'required|string|max:255',
            'imei_1'                => 'nullable|string|max:100',
            'imei_2'                => 'nullable|string|max:100',
            'imei_3_or_mac_or_plate'=> 'nullable|string|max:100',
            'type'                  => 'nullable|string|max:100',
            'os'                    => 'nullable|string|max:100',
            'status'                => 'nullable|string|in:active,inactive,under_repair,lost,stolen,repair_approved',
            'purchase_date'         => 'nullable|date',
            'warranty_expiry'       => 'nullable|date',
            'location'              => 'nullable|string|max:255',
            'notes'                 => 'nullable|string',                 
        ]);

        $device = Device::create($validated);

        // Broadcast activity
        $activity = Activity::create([
            'message' => 'New device registered: ' . $device->brand . ' ' . $device->model,
            'icon'    => 'fas fa-mobile-alt',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->route('web.register_device', ['step' => 3, 'device_id' => $device->id])
                         ->with('success', 'Device saved successfully. Now register technician.');
    }

    // Store technician, then show final thank you (step 4)
    public function storeTechnician(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'nullable|email|max:255',
            'phone'            => 'nullable|string|max:20',
            'expertise'        => 'required|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'certifications'   => 'nullable|string|max:255',
            'status'           => 'nullable|string|in:active,inactive,on_leave',
            'location'         => 'nullable|string|max:255',
            'notes'            => 'nullable|string',
            'registered_on'    => 'nullable|date',
            'received_by'      => 'nullable|string|max:255',
            'position'         => 'nullable|string|max:255',
            'device_id'        => 'nullable|exists:devices,id',
        ]);

        // ✅ Prevent duplicate email
        if ($request->filled('email') && Technician::where('email', $request->email)->exists()) {
            return back()->withErrors(['email' => 'This email is already taken.'])->withInput();
        }

        $technician = Technician::create($request->only([
            'name', 'email', 'phone', 'expertise', 'experience_years', 'certifications',
            'status', 'location', 'notes', 'registered_on', 'received_by', 'position'
        ]));

        // ✅ Assign device if provided
        if ($request->filled('device_id')) {
            $device = Device::find($request->input('device_id'));
            if ($device) {
                $device->assigned_technician_id = $technician->id;
                $device->save();
            }
        }

        // Broadcast activity
        $activity = Activity::create([
            'message' => 'New technician registered: ' . $technician->name,
            'icon'    => 'fas fa-user-cog',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->route('web.register_device', ['step' => 4])
                         ->with('success', 'Technician saved successfully. Process completed.');
    }
}
