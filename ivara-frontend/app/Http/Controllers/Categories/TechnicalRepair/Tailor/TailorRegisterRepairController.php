<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\TailorRepair;

class TailorRegisterRepairController extends Controller
{
    // Display all repairs
    public function index()
    {
        $repairs = TailorRepair::orderBy('date_received', 'desc')->get();
        return view('tailor.register_repair', compact('repairs'));
    }

    // Store a new repair
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'item_name' => 'required|string|max:255',
            'repair_details' => 'required|string',
            'date_received' => 'required|date',
        ]);

        TailorRepair::create($request->all());

        return redirect()->route('tailor.register_repair')->with('success', 'Repair registered successfully!');
    }

    // Update an existing repair
    public function update(Request $request, $id)
    {
        $repair = TailorRepair::findOrFail($id);

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'item_name' => 'required|string|max:255',
            'repair_details' => 'required|string',
            'date_received' => 'required|date',
        ]);

        $repair->update($request->all());

        return redirect()->route('tailor.register_repair')->with('success', 'Repair updated successfully!');
    }

    // Delete a repair
    public function destroy($id)
    {
        $repair = TailorRepair::findOrFail($id);
        $repair->delete();

        return redirect()->route('tailor.register_repair')->with('success', 'Repair deleted successfully!');
    }
}
