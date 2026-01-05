<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Meeting;

class MechanicianMeetingController extends Controller
{
    /**
     * Display all published meetings assigned to mechanics.
     */
    public function index()
    {
        // Fetch meetings where status is Published and roles JSON contains "mechanic"
        $meetings = Meeting::where('status', 'Published')
            ->whereJsonContains('roles', 'mechanic')
            ->orderBy('time', 'asc')
            ->get();

        return view('mechanic.meetings', compact('meetings'));
    }
}
