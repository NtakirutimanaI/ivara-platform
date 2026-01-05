<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Mediator;

class MechanicMediatorController extends Controller
{
    /**
     * Display a list of nearby mediators based on location.
     */
    public function index(Request $request)
    {
        // Get all unique locations from mediators table
        $locations = Mediator::select('location')
            ->distinct()
            ->pluck('location')
            ->filter() // remove null/empty
            ->values(); // reset keys

        $location = $request->input('location');
        $perPage = $request->input('per_page', 5);

        $mediators = collect(); // default empty collection

        if ($location) {
            // Fetch mediators for the selected location
            $mediators = Mediator::where('location', $location)
                ->paginate($perPage)
                ->withQueryString(); // keep query params for pagination links
        }

        return view('mechanic.mediator', compact('locations', 'mediators', 'location'));
    }
}
