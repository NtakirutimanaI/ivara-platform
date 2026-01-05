<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Mediator; // Assuming your mediator model is called Mediator

class BusinessConnectionController extends Controller
{
    /**
     * Display a listing of business connections (mediators).
     */
    public function index(Request $request)
    {
        // Fetch unique locations for the dropdown
        $locations = Mediator::select('location')->distinct()->get();

        $mediators = [];

        // If a location is selected, fetch mediators in that location
        if ($request->has('location') && !empty($request->location)) {
            $mediators = Mediator::where('location', $request->location)
                                  ->orderBy('fullname', 'asc')
                                  ->get();
        }

        return view('business.connections.index', compact('mediators', 'locations'));
    }
}
