<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display all team members in the admin panel.
     */
    public function adminIndex()
    {
        $team = Team::all();
        return view('admin.create_team', compact('team'));
    }

    /**
     * Display first team member in manager panel.
     * (you can change this to all if you want a table)
     */
         public function managerIndex()
     {
         $team = Team::all();   
         return view('manager.create_team', compact('team'));
     }     

    /**
     * Show form to create a new team member (Admin).
     */
    public function create()
    {
        $team = Team::all(); // so the table still shows
        return view('admin.create_team', compact('team'));
    }

    /**
     * Store a new team member in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:100',
            'position'  => 'required|string|max:100',
            'contact'   => 'nullable|string|max:50',
            'email'     => 'nullable|email|max:100',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook'  => 'nullable|url',
            'twitter'   => 'nullable|url',
            'linkedin'  => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('team', 'public');
        }

        // Default status is unpublished
        $data['status'] = 'unpublished';

        $team = Team::create($data);

        // $team is an Eloquent model, so we can safely use $team->id here
        return redirect()->back()->with('success', 'Team member added successfully! ID: ' . $team->id);
    }

    /**
     * Toggle publish/unpublish status of a team member.
     */
    public function toggleStatus(Request $request, $id)
    {
        $member = Team::findOrFail($id);
        $member->status = $member->status === 'published' ? 'unpublished' : 'published';
        $member->save();

        return response()->json(['status' => $member->status === 'published']);
    }

    /**
     * Edit a team member (Admin).
     */
    public function edit($id)
    {
        $member = Team::findOrFail($id);
        return view('admin.edit_team', compact('member'));
    }

    /**
     * Update team member information (Admin).
     */
    public function update(Request $request, $id)
    {
        $member = Team::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:100',
            'position'  => 'required|string|max:100',
            'contact'   => 'nullable|string|max:50',
            'email'     => 'nullable|email|max:100',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook'  => 'nullable|url',
            'twitter'   => 'nullable|url',
            'linkedin'  => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('team', 'public');
        }

        $member->update($data);

        return redirect()->back()->with('success', 'Team member updated successfully! ID: ' . $member->id);
    }

    /**
     * Delete a team member (Admin).
     */
    public function destroy($id)
    {
        $member = Team::findOrFail($id);

        // Delete image from storage if exists
        if ($member->image) {
            Storage::disk('public')->delete($member->image);
        }

        $member->delete();

        return redirect()->back()->with('success', 'Team member deleted successfully! ID: ' . $member->id);
    }

    /**
     * Display published team members on the website (Public view).
     */
    public function index()
    {
        $team = Team::where('status', 'published')->get();
        return view('web.team', compact('team'));
    }

    /**
     * Show a single team member (Public view, optional).
     */
    public function show($id)
    {
        $member = Team::findOrFail($id);
        return view('web.team_member', compact('member'));
    }
}
