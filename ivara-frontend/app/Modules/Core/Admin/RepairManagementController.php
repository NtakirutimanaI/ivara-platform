<?php

namespace App\Modules\Core\Admin\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;

class RepairManagementController extends Controller
{
    public function admin()
    {
        $devices = Device::latest()->paginate(10);
        return view('admin.devices.repairs', compact('devices'));
    }

    public function managerIndex(Request $request)
    {
        $query = Device::query();

        // Filter by technician
        if ($request->filled('technician')) {
            $query->where('technician', 'LIKE', "%{$request->technician}%");
        }

        // Filter by repair status
        if ($request->filled('status')) {
            $query->where('repair_status', $request->status);
        }

        // Filter by date range
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('updated_at', [$request->from, $request->to]);
        }

        $devices = $query->orderBy('updated_at', 'desc')->paginate(10);

        // Return the manager view
        return view('manager.devices.repairs', compact('devices'));
    }
}
