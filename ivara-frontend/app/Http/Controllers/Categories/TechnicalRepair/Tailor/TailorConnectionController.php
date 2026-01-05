<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller; // <--- THIS is the default namespace, NOT Tailor

use Illuminate\Http\Request;
use App\Models\Mediator;

class TailorConnectionController extends Controller
{
    public function index(Request $request)
    {
        $locations = Mediator::select('location')->distinct()->get();
        $mediators = [];
        if ($request->has('location') && $request->location != '') {
            $mediators = Mediator::where('location', $request->location)->get();
        }
        return view('tailor.connections', compact('locations', 'mediators'));
    }
}
