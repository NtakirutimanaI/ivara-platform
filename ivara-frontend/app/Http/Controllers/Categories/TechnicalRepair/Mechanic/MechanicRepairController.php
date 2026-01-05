<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use App\Models\Vehicle;
use App\Models\VehicleRepair;
use App\Models\Payment;
use Illuminate\Http\Request;

class MechanicRepairController extends Controller
{
    // Display all repairs
    public function repairs()
    {
        $repairs = VehicleRepair::with('vehicle')->orderBy('id', 'desc')->paginate(10);
        $vehicles = Vehicle::all(); // For the "Add Repair" form
        return view('mechanic.devices.repairs', compact('repairs', 'vehicles'));
    }

    // Store a new repair
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'technician' => 'nullable|string|max:255',
            'problem_description' => 'nullable|string',
            'repair_status' => 'required|in:Pending,In Progress,Completed',
            'repair_price' => 'nullable|numeric|min:0',
        ]);

        VehicleRepair::create($request->all());

        return redirect()->back()->with('success', 'Repair registered successfully.');
    }

    // Update an existing repair
    public function update(Request $request, $id)
    {
        $repair = VehicleRepair::findOrFail($id);

        $request->validate([
            'technician' => 'nullable|string|max:255',
            'solved_problems' => 'nullable|string',
            'recommendations' => 'nullable|string',
            'repair_status' => 'required|in:Pending,In Progress,Completed',
            'repair_price' => 'nullable|numeric|min:0',
        ]);

        $repair->update($request->all());

        return redirect()->back()->with('success', 'Repair updated successfully.');
    }

    // Pay for a repair
    public function payRepair(Request $request, $repairId)
    {
        $repair = VehicleRepair::findOrFail($repairId);

        if (!$repair->repair_price || $repair->repair_price <= 0) {
            return redirect()->back()->with('error', 'Repair price not set.');
        }

        // Check if already paid
        $existingPayment = Payment::where('invoice_id', $repair->id)
                            ->where('status', 'success')
                            ->first();
        if ($existingPayment) {
            return redirect()->back()->with('info', 'This repair is already paid.');
        }

        Payment::create([
            'invoice_id' => $repair->id,
            'client_id' => $repair->vehicle->client_id ?? null,
            'plan' => 'Repair Payment',
            'method' => $request->method,
            'payment_amount' => $repair->repair_price,
            'status' => 'success', // mark as paid
            'paid_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Payment completed successfully.');
    }

    // Delete a repair
    public function destroy($id)
    {
        $repair = VehicleRepair::findOrFail($id);
        $repair->delete();

        return redirect()->back()->with('success', 'Repair deleted successfully.');
    }
}
