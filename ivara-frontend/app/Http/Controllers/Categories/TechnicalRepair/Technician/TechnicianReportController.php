<?php
namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TechnicianReportController extends Controller
{
    public function storeRepair(Request $request)
{
    // validate and store

    return redirect()->route('technician.register_repair')
        ->with('success', 'Repair registered successfully.');
}

}
