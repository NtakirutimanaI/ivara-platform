<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Repair;
use Illuminate\Support\Facades\Storage;

class RepairController extends Controller
{
    // -------------------- Repair Methods --------------------

    /**
     * Display a listing of repairs.
     */
    public function index(Request $request)
    {
        $query = Repair::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('device_name', 'like', "%{$search}%")
                  ->orWhere('device_owner', 'like', "%{$search}%")
                  ->orWhere('technician', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('repair_status', $request->status);
        }

        // Date range filter
        if ($request->filled('from')) {
            $query->whereDate('received_date', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('received_date', '<=', $request->to);
        }

        $repairs = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.devices.repairs', compact('repairs'));
    }

    /**
     * Show the form for creating a new repair.
     */
    public function create()
    {
        return view('admin.repair_device');
    }

    /**
     * Store a newly created repair in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id'            => 'required|exists:devices,id',
            'device_type'          => 'required|string|max:255',
            'device_name'          => 'required|string|max:255',
            'serial_number'        => 'required|string|max:255|unique:repairs,serial_number',
            'brand'                => 'required|string|max:255',
            'model'                => 'required|string|max:255',
            'operating_system'     => 'nullable|string|max:255',
            'device_owner'         => 'required|string|max:255',
            'contact_number'       => 'required|string|max:255',
            'received_date'        => 'required|date',
            'warranty_status'      => 'required|in:Under Warranty,Out of Warranty',
            'problem_description'  => 'required|string|max:1000',
            'technician'           => 'nullable|string|max:255',
            'estimated_cost'       => 'nullable|numeric|min:0',
            'repair_status'        => 'nullable|in:Pending,In Progress,Completed',
            'repair_report_file'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('repair_report_file')) {
            $file = $request->file('repair_report_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/repairs', $filename);
            $validated['repair_report_file'] = $filename;
        }

        // Default repair status if not provided
        if (empty($validated['repair_status'])) {
            $validated['repair_status'] = 'Pending';
        }

        Repair::create($validated);

        return redirect()->back()->with('success', 'Repair added successfully.');
    }

    /**
     * Show a single repair (JSON for AJAX modals).
     */
    public function show($id)
    {
        $repair = Repair::findOrFail($id);
        return response()->json($repair);
    }

    /**
     * Update repair information (from modal - partial update).
     */
    public function update(Request $request, $id)
    {
        $repair = Repair::findOrFail($id);

        $validated = $request->validate([
            'technician'           => 'nullable|string|max:255',
            'estimated_cost'       => 'nullable|numeric|min:0',
            'solved_problems'      => 'nullable|string|max:1000',
            'recommendations'      => 'nullable|string|max:1000',
            'repair_status'        => 'required|in:Pending,In Progress,Completed',
        ]);

        $repair->update($validated);

        return redirect()->route('admin.devices.repairs')->with('success', 'Repair updated successfully.');
    }

    /**
     * Update repair status only.
     */
    public function updateStatus(Request $request, $id)
    {
        $repair = Repair::findOrFail($id);

        $validated = $request->validate([
            'repair_status' => 'required|in:Pending,In Progress,Completed',
        ]);

        $repair->repair_status = $validated['repair_status'];
        $repair->save();

        return redirect()->route('admin.devices.repairs')->with('success', 'Repair status updated successfully.');
    }

    /**
     * Delete a repair record.
     */
    public function destroy($id)
    {
        $repair = Repair::findOrFail($id);
        
        if ($repair->repair_report_file && Storage::exists('public/repairs/' . $repair->repair_report_file)) {
            Storage::delete('public/repairs/' . $repair->repair_report_file);
        }

        $repair->delete();

        return redirect()->route('admin.devices.repairs')->with('success', 'Repair deleted successfully.');
    }

    // -------------------- Client Repair Registration --------------------

    public function clientRegisterRepair()
    {
        return view('client.register_repair');
    }

    public function clientRegisterDevice(Request $request)
    {
        $step = $request->session()->get('step', 1);
        $client_id = $request->session()->get('client_id');
        $device_id = $request->session()->get('device_id');

        return view('client.register_repair', compact('step', 'client_id', 'device_id'));
    }
}
