<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Connection;
use App\Models\Technician;
use App\Models\Mediator;

class AdminManageConnectionController extends Controller
{
    // Display Manage Connections page
 public function manageConnections()
{
    $connections = Connection::with(['client', 'service', 'technician'])->get();
    $technicians = Technician::all();
    $locations = Connection::select('location')->distinct()->pluck('location');
    $mediators = Mediator::all(); // <-- Add this line

    return view('admin.connections', compact('connections', 'technicians', 'locations', 'mediators'));
}


    // Update Technician inline
    public function updateTechnician(Request $request, $id)
    {
        $connection = Connection::find($id);
        if(!$connection) return response()->json(['success'=>false]);

        $connection->technician_id = $request->technician_id;
        $connection->save();

        return response()->json(['success'=>true]);
    }

    // Update Payment inline
    public function updatePayment(Request $request, $id)
    {
        $connection = Connection::find($id);
        if(!$connection) return response()->json(['success'=>false]);

        $connection->payment_method = $request->payment_method;
        $connection->save();

        return response()->json(['success'=>true]);
    }

    // Update Status inline
    public function updateStatus(Request $request, $id)
    {
        $connection = Connection::find($id);
        if(!$connection) return response()->json(['success'=>false]);

        $connection->status = $request->status;
        $connection->save();

        return response()->json(['success'=>true]);
    }

    // Show single connection details (for modal)
    public function show($id)
    {
        $connection = Connection::with(['technician','service','client'])->find($id);
        if(!$connection) return "<p>Connection not found.</p>";

        return view('admin.partials.connection-details', compact('connection'));
    }

    // Delete a connection
    public function destroy($id)
    {
        $connection = Connection::find($id);
        if(!$connection) return response()->json(['success'=>false]);

        $connection->delete();
        return response()->json(['success'=>true]);
    }
}
