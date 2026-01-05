<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\User;
use App\Models\Feedback;

class MediatorMeetingController extends Controller
{
    public function meetings()
    {
        // Dashboard statistics (optional)
        $scheduledMeetings = Meeting::where('status', 'Scheduled')->count();
        $newClients = User::where('role', 'client')->count();
        $unreadFeedback = Feedback::where('status', 'Unread')->count();

        // ✅ Fetch all published meetings
        $meetings = Meeting::where('status', 'Published')
            ->orderBy('time', 'desc')
            ->get()
            ->filter(function ($meeting) {
                // Decode roles from JSON or escaped JSON
                $roles = json_decode($meeting->roles, true);
                if (!$roles) {
                    $roles = json_decode(stripslashes($meeting->roles), true) ?? [];
                }
                // Keep only meetings where mediator is in roles
                return in_array('mediator', $roles);
            });

        return view('mediator.meetings', compact(
            'scheduledMeetings',
            'newClients',
            'unreadFeedback',
            'meetings'
        ));
    }
}
