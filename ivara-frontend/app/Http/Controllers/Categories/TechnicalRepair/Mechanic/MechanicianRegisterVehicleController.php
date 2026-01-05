<?php
namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class MechanicianRegisterVehicleController extends Controller
{
    // Show all vehicles
    public function index()
    {
        $vehicles = Vehicle::paginate(5);
        return view('mechanic.register_vehicle', compact('vehicles'));
    }

    // Show form (optional, can use index modal)
    public function create()
    {
        return view('mechanic.register_vehicle');
    }

    // Store new vehicle
    public function store(Request $request)
    {
        $validated = $request->validate([
            'registration_number' => 'required|string|max:255|unique:vehicles',
            'make'                => 'required|string|max:255',
            'model'               => 'required|string|max:255',
            'year'                => 'nullable|integer',
            'color'               => 'nullable|string|max:255',
            'vehicle_type'        => 'nullable|string|max:255',
            'status'              => 'required|string|in:active,inactive,scrapped',
        ]);

        Vehicle::create($validated);

        return redirect()->route('mechanic.register_vehicle')->with('success', 'Vehicle registered successfully');
    }

    // Update vehicle
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $validated = $request->validate([
            'registration_number' => 'required|string|max:255|unique:vehicles,registration_number,' . $id,
            'make'                => 'required|string|max:255',
            'model'               => 'required|string|max:255',
            'year'                => 'nullable|integer',
            'color'               => 'nullable|string|max:255',
            'vehicle_type'        => 'nullable|string|max:255',
            'status'              => 'required|string|in:active,inactive,scrapped',
        ]);

        $vehicle->update($validated);

        return redirect()->route('mechanic.register_vehicle')->with('success', 'Vehicle updated successfully');
    }

    // Delete vehicle (optional)
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('mechanic.register_vehicle')->with('success', 'Vehicle deleted successfully');
    }
}
