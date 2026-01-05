<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\BusinessRegister;

class BusinessRegisterRepairController extends Controller
{
    /**
     * Display a listing of the repairs (registered items).
     */
    public function index()
    {
        // Fetch all registered items for the logged-in business person
        $items = BusinessRegister::where('business_id', auth()->id())->get();

        // Pass $items to the view
        return view('business.register_repair', compact('items'));
    }

    /**
     * Store a newly created item in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'name' => 'required|string|max:255',
            'quantity' => 'nullable|integer',
        ]);

        BusinessRegister::create([
            'business_id'   => auth()->id(),
            'type'          => $request->type,
            'name'          => $request->name,
            'serial_number' => $request->serial_number,
            'description'   => $request->description,
            'category'      => $request->category,
            'quantity'      => $request->quantity,
            'location'      => $request->location,
            'status'        => $request->status ?? 'active',
        ]);

        return redirect()->back()->with('success', 'Item registered successfully!');
    }

    /**
     * Update the specified item in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type'     => 'required|string',
            'name'     => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'quantity' => 'nullable|numeric',
            'status'   => 'required|string|in:active,inactive',
        ]);

        $item = BusinessRegister::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('business.register_repair')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified item from storage.
     */
    public function destroy($id)
    {
        $item = BusinessRegister::findOrFail($id);
        $item->delete();

        return redirect()->route('business.register_repair')->with('success', 'Item deleted successfully.');
    }
}
