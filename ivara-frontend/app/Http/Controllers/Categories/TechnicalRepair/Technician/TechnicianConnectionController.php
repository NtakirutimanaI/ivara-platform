<?php

namespace App\Modules\TechnicalRepair\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mediator;

class TechnicianConnectionController extends Controller
{
    public function index(Request $request) 
    {
        $locations = Mediator::select('location')->distinct()->get();

        $mediators = [];
        if ($request->has('location') && $request->location != '') {
            $mediators = Mediator::where('location', $request->location)->get();
        }
        return view('technician.connections', compact('locations', 'mediators'));
    }



    
    public function mediatorsByLocation(Request $request)
    {
    $locations = Mediator::select('location')->distinct()->get(); // get unique locations

    $mediators = [];
    if ($request->location) {
        $mediators = Mediator::where('location', $request->location)->get();
    }

    return view('technician.connections', compact('locations', 'mediators'));
    }
}
