<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\BusinessMeeting;

class BusinessMeetingController extends Controller
{
    /**
     * Display a listing of published meetings for businesspersons.
     */
    public function index()
    {
        // Fetch only published meetings where roles include "businessperson"
        $meetings = BusinessMeeting::where('status', 'Published')
            ->whereJsonContains('roles', 'businessperson')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('business.meetings', compact('meetings'));
    }

    /**
     * Show the form for creating a new meeting.
     */
    public function create()
    {
        return view('business.meetings.create');
    }

    /**
     * Store a newly created meeting in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'time' => 'required|date_format:H:i',
            'link' => 'required|url',
            'description' => 'nullable|string',
            'status' => 'nullable|in:Published,Unpublished',
            'roles' => 'nullable|array',
        ]);

        BusinessMeeting::create([
            'time' => $validated['time'],
            'link' => $validated['link'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'] ?? 'Unpublished',
            'roles' => isset($validated['roles']) && is_array($validated['roles'])
                ? collect($validated['roles'])->values()->toJson(JSON_UNESCAPED_SLASHES)
                : null,
        ]);

        return redirect()->route('business.meetings.index')
                         ->with('success', 'Meeting created successfully!');
    }

    /**
     * Display the specified meeting.
     */
    public function show(BusinessMeeting $meeting)
    {
        return view('business.meetings.show', compact('meeting'));
    }

    /**
     * Show the form for editing the specified meeting.
     */
    public function edit(BusinessMeeting $meeting)
    {
        return view('business.meetings.edit', compact('meeting'));
    }

    /**
     * Update the specified meeting in storage.
     */
    public function update(Request $request, BusinessMeeting $meeting)
    {
        $validated = $request->validate([
            'time' => 'required|date_format:H:i',
            'link' => 'required|url',
            'description' => 'nullable|string',
            'status' => 'nullable|in:Published,Unpublished',
            'roles' => 'nullable|array',
        ]);

        $meeting->update([
            'time' => $validated['time'],
            'link' => $validated['link'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'] ?? $meeting->status,
            'roles' => isset($validated['roles']) && is_array($validated['roles'])
                ? collect($validated['roles'])->values()->toJson(JSON_UNESCAPED_SLASHES)
                : $meeting->roles,
        ]);

        return redirect()->route('business.meetings.index')
                         ->with('success', 'Meeting updated successfully!');
    }

    /**
     * Remove the specified meeting from storage.
     */
    public function destroy(BusinessMeeting $meeting)
    {
        $meeting->delete();

        return redirect()->route('business.meetings.index')
                         ->with('success', 'Meeting deleted successfully!');
    }
}
