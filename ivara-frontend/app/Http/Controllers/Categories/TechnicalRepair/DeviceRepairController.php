<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DeviceRepairController extends Controller
{
    public function repair(Request $request)
    {
        // Validate input
        $request->validate([
            'serial_number'   => 'required|string',
            'issues'          => 'required|string',
            'solved_problems' => 'nullable|string',
            'recommendations' => 'nullable|string',
        ]);

        // Find device by serial_number (case-insensitive)
        $device = Device::whereRaw('LOWER(serial_number) = ?', [strtolower($request->serial_number)])->first();

        if (!$device) {
            return back()->with('error', 'Device not found! Please check serial number.');
        }

        // Update record permanently
        $device->problem_description = $request->issues;
        $device->solved_problems     = $request->solved_problems ?? '-';
        $device->recommendations     = $request->recommendations ?? '-';
        $device->technician          = auth()->user()->name ?? 'Unknown Technician';
        $device->repair_status       = 'Completed';
        $device->status              = 'repaired';
        $device->updated_at          = now();

        $device->save(); // <-- this ensures data is written!

        // Optional email notification
        if (!empty($device->device_owner) && filter_var($device->contact_number, FILTER_VALIDATE_EMAIL)) {
            Mail::raw("
Hello {$device->device_owner},

Your device has been repaired successfully.

Brand: {$device->brand}
Model: {$device->model}
Serial Number: {$device->serial_number}
Solved Problems: {$device->solved_problems}
Recommendations: {$device->recommendations}

Thank you for trusting IVARA Group!

", function ($message) use ($device) {
                $message->to($device->contact_number)
                        ->subject('Device Repair Completed');
            });
        }

        return back()->with('success', 'Device repaired successfully and saved!');
    }
}
