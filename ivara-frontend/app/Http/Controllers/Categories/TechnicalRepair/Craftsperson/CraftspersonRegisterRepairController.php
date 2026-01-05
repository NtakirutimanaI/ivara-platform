<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;
use App\Models\CraftspersonRegisterRepair;

class CraftspersonRegisterRepairController extends Controller
{
    /**
     * Display a listing of the repairs.
     */
    public function index()
    {
        $repairs = CraftspersonRegisterRepair::orderBy('repair_date', 'desc')->paginate(10);
        return view('craftsperson.register_repair', compact('repairs'));
    }

    /**
     * Store a newly created repair (from Add modal).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'craftsperson_name' => 'required|string|max:255',
            'craft_type'        => 'required|string|max:255',
            'repair_item'       => 'required|string|max:255',
            'repair_description'=> 'nullable|string',
            'repair_date'       => 'required|date',
            'repair_cost'       => 'nullable|numeric',
            'status'            => 'required|in:Pending,In Progress,Completed',
            'client_name'       => 'nullable|string|max:255',
            'client_contact'    => 'nullable|string|max:255',
        ]);

        CraftspersonRegisterRepair::create($validated);

        return redirect()->route('craftsperson.repairs.index')
                         ->with('success', 'Repair registered successfully.');
    }

    /**
     * Update the specified repair (from Edit modal).
     */
    public function update(Request $request, $id)
    {
        $repair = CraftspersonRegisterRepair::findOrFail($id);

        $validated = $request->validate([
            'craftsperson_name' => 'required|string|max:255',
            'craft_type'        => 'required|string|max:255',
            'repair_item'       => 'required|string|max:255',
            'repair_description'=> 'nullable|string',
            'repair_date'       => 'required|date',
            'repair_cost'       => 'nullable|numeric',
            'status'            => 'required|in:Pending,In Progress,Completed',
            'client_name'       => 'nullable|string|max:255',
            'client_contact'    => 'nullable|string|max:255',
        ]);

        $repair->update($validated);

        return redirect()->route('craftsperson.repairs.index')
                         ->with('success', 'Repair updated successfully.');
    }

    /**
     * Remove the specified repair (from Delete modal).
     */
    public function destroy($id)
    {
        $repair = CraftspersonRegisterRepair::findOrFail($id);
        $repair->delete();

        return redirect()->route('craftsperson.repairs.index')
                         ->with('success', 'Repair deleted successfully.');
    }

    public function pay(Request $request, $id)
{
    $repair = CraftspersonRegisterRepair::findOrFail($id);

    Payment::create([
        'invoice_id' => $repair->id,
        'client_id' => $repair->client_id ?? null,
        'plan' => 1, // adjust if needed
        'method' => $request->payment_method,
        'transaction_id' => $request->transaction_id,
        'payment_amount' => $repair->repair_cost,
        'status' => 'success',
        'paid_at' => Carbon::now(),
        'meta' => json_encode([
            'notes' => $request->notes,
            'repair_item' => $repair->repair_item
        ]),
    ]);

    $repair->status = 'Completed';
    $repair->save();

    return redirect()->back()->with('success', 'Payment recorded successfully.');
}

}
