<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Meeting; // Make sure this model exists

class TailorMeetingController extends Controller
{
    /**
     * Display published meetings for tailors only.
     */
    public function index()
    {
        // Fetch meetings with status 'Published' and roles containing 'tailor'
        $meetings = Meeting::where('status', 'Published')
            ->whereJsonContains('roles', 'tailor')
            ->orderBy('time', 'asc')
            ->paginate(10);

        return view('tailor.meetings', compact('meetings'));
    }
}
