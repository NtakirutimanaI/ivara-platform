<?php
// app/Http/Controllers/Admin/DeviceTrackingController.php
namespace App\Modules\TechnicalRepair\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Device;

class DeviceTrackingController extends Controller
{
    public function index()
    {
        $devices = Device::with('user', 'client')->get();
        return view('supervisor.devices.tracking', compact('devices'));
    }
}
