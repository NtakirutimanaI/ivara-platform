<?php
namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BusinessTypeController extends Controller
{
    public function select(Request $request)
    {
        $type = strtolower($request->input('business_type'));

        switch ($type) {
            case 'businessperson':
                return redirect()->route('businessperson.dashboard');
            case 'technician':
                return redirect()->route('technician.dashboard');
            case 'mechanic':
                return redirect()->route('mechanic.dashboard');
            case 'tailor':
                return redirect()->route('tailor.dashboard');
            case 'craftsperson':
                return redirect()->route('craftsperson.dashboard');
            case 'mediator':
                return redirect()->route('mediator.dashboard');
            case 'client':
                return redirect()->route('client.dashboard');
            default:
                return redirect()->route('dashboard')->with('error', 'Invalid business type');
        }
    }
}
