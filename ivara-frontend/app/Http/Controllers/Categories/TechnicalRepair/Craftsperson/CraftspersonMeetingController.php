<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Meeting;

class CraftspersonMeetingController extends Controller
{
    // Display all meetings for craftsperson
    public function index()
    {
        // Fetch only published meetings for craftsperson role
        $meetings = Meeting::where('status', 'Published')
            ->whereJsonContains('roles', 'craftsperson')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('craftsperson.meetings', compact('meetings'));
    }
}
