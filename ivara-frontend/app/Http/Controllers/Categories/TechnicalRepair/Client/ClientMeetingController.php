<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;

class ClientMeetingController extends Controller
{
    /**
     * Display all published meetings for the logged-in client
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch only published meetings for this client, paginate 10 per page
        $meetings = Meeting::where('client_id', $user->id)
            ->where('status', 'Published') // only show published meetings
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Pass to Blade
        return view('client.meeting', compact('meetings'));
    }

    /**
     * Optional AJAX endpoint to get meetings as JSON
     */
    public function getClientMeetings()
    {
        $user = Auth::user();

        $meetings = Meeting::where('client_id', $user->id)
            ->where('status', 'Published')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'time', 'link', 'description', 'status', 'created_at']);

        return response()->json($meetings);
    }
}
