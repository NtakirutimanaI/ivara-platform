<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Mediator;
use App\Models\Transaction;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ConnectionController extends Controller
{
    /**
     * Display all mediators to admin
     */
    public function adminConnections()
    {
        // Use pagination instead of all() so ->links() works in Blade
        $mediators = Mediator::paginate(10); 
        return view('admin.connections', compact('mediators'));
    }

    /**
     * Store a new mediator
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:mediators,email',
            'phone' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'level' => 'required|string|in:basic,advanced,premium',
        ]);

        $mediator = Mediator::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'location' => $request->location,
            'level' => $request->level,
            'total_clients' => 0,
            'total_transactions' => 0,
            'status' => 'active',
            'approved_by_admin' => 0,
        ]);

        // Log activity
        Activity::create([
            'user_id' => Auth::id(),
            'action' => "Added mediator: {$mediator->fullname}",
        ]);

        return redirect()->back()->with('success', 'Mediator added successfully.');
    }

    /**
     * Update mediator
     */
    public function update(Request $request, $id)
    {
        $mediator = Mediator::findOrFail($id);

        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => "required|email|unique:mediators,email,{$id}",
            'phone' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'level' => 'required|string|in:basic,advanced,premium',
            'status' => 'required|in:active,inactive',
        ]);

        $mediator->update($request->only([
            'fullname', 'email', 'phone', 'location', 'level', 'status'
        ]));

        Activity::create([
            'user_id' => Auth::id(),
            'action' => "Updated mediator: {$mediator->fullname}",
        ]);

        return redirect()->back()->with('success', 'Mediator updated successfully.');
    }

    /**
     * Delete mediator
     */
    public function destroy($id)
    {
        $mediator = Mediator::findOrFail($id);
        $mediatorName = $mediator->fullname;
        $mediator->delete();

        Activity::create([
            'user_id' => Auth::id(),
            'action' => "Deleted mediator: {$mediatorName}",
        ]);

        return redirect()->back()->with('success', 'Mediator deleted successfully.');
    }

    /**
     * Approve mediator by admin
     */
    public function approve($id)
    {
        $mediator = Mediator::findOrFail($id);
        $mediator->approved_by_admin = 1;
        $mediator->save();

        return redirect()->back()->with('success', 'Mediator approved successfully.');
    }

    /**
     * Optional: View mediator details (for modal)
     */
    public function show($id)
    {
        $mediator = Mediator::findOrFail($id);
        return response()->json($mediator);
    }
}
