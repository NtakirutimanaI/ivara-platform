<?php

namespace App\Modules\TechnicalRepair\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meeting;

class TechnicianMeetingController extends Controller
{
    /**
     * Display all published meetings assigned to technicians.
     */
    public function technicianMeetings()
    {
        // Fetch meetings where status is Published and roles JSON contains "technician"
        $meetings = Meeting::where('status', 'Published')
            ->whereJsonContains('roles', 'technician')
            ->get();

        // Pass to the view
        return view('technician.meetings', compact('meetings'));
    }
}
