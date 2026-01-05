<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    // ============================
    // Admin/Manager/Supervisor CRUD
    // ============================

    // Display all meetings (admin/manager/supervisor)
    public function index()
    {
        $meetings = Meeting::all();
        return view('admin.meetings', compact('meetings'));
    }

    // Store a new meeting
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'time' => 'required|date_format:H:i',
            'link' => 'required|url',
            'description' => 'nullable|string',
        ]);

        // Create meeting
        Meeting::create($validated);

        return redirect()->back()->with('success', 'Meeting created successfully!');
    }

    // Update existing meeting
    public function update(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);

        $validated = $request->validate([
            'time' => 'required|date_format:H:i',
            'link' => 'required|url',
            'description' => 'nullable|string',
        ]);

        $meeting->update($validated);

        return redirect()->back()->with('success', 'Meeting updated successfully!');
    }

    // Delete a meeting
    public function destroy($id)
    {
        $meeting = Meeting::findOrFail($id);
        $meeting->delete();

        return redirect()->back()->with('success', 'Meeting deleted successfully!');
    }

    // Publish a meeting
    public function publish(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);
        $roles = $request->input('roles', []);
        $meeting->roles = json_encode($roles);
        $meeting->status = 'Published';
        $meeting->save();

        return redirect()->back()->with('success', 'Meeting published successfully!');
    }

    // Unpublish a meeting
    public function unpublish($id)
    {
        $meeting = Meeting::findOrFail($id);
        $meeting->status = 'Unpublished';
        $meeting->save();

        return redirect()->back()->with('success', 'Meeting unpublished successfully!');
    }

    // ============================
    // Role-based published meetings
    // ============================

    public function roleIndex($role)
    {
        $user = Auth::user();

        // Confirm that the role in URL matches the user's role
        if (strtolower($user->role) !== strtolower($role)) {
            abort(403, 'Unauthorized');
        }

        // Fetch only published meetings for this role
        $meetings = Meeting::where('status', 'Published')
            ->whereJsonContains('roles', strtolower($role))
            ->get();

        return view('meetings.view', compact('meetings', 'role'));
    }
    

     public function roleMeetings(Request $request)
{
    // Get the role from route default
    $role = $request->route('role'); // <- important

    // Fetch meetings for this role
    $meetings = Meeting::where('status', 'Published')
                       ->whereJsonContains('roles', $role)
                       ->orderBy('time', 'asc')
                       ->get();

    // Pass role and meetings to the view
    return view("$role.meetings", compact('meetings', 'role'));
}

    public function technicianMeetings()
{
    $user = auth()->user();
    $role = strtolower($user->role); // this will be 'technician'

    $meetings = Meeting::where('status', 'Published')
        ->whereJsonContains('roles', 'technician')
        ->orderBy('time', 'asc')
        ->get();

    return view('technician.meetings', compact('role', 'meetings'));
}

    public function tailorMeetings()
{
    $user = auth()->user();
    $role = strtolower($user->role); // this will be 'tailor'

    $meetings = Meeting::where('status', 'Published')
        ->whereJsonContains('roles', 'tailor')
        ->orderBy('time', 'asc')
        ->get();

    return view('tailor.meetings', compact('role', 'meetings'));
}

public function supervisorMeetings()
{
    $meetings = Meeting::all(); // or apply filters if needed

    return view('supervisor.meetings', compact('meetings'));
}

}
