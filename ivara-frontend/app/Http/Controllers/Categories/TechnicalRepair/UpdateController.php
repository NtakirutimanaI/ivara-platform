<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use App\Models\Update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Activity;
use App\Events\ActivityCreated;

class UpdateController extends Controller
{
    /**
     * Display all updates on the frontend.
     */
    public function index()
    {
        $updates = Update::orderBy('date', 'desc')->get();
        return view('web.updates', compact('updates'));
    }

    /**
     * Show the admin form and list all updates.
     */
    public function create_updates()
    {
        $updates = Update::orderBy('date', 'desc')->get();
        return view('admin.create_updates', compact('updates'));
    }

    /**
     * Store a new update with optional image upload.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'date'       => 'required|date',
            'location'   => 'required|string|max:255',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description'=> 'required|string',
        ]);

        $imagePath = null;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('updates_images', 'public');
        }

        $update = Update::create([
            'event_name' => $request->event_name,
            'date'       => $request->date,
            'location'   => $request->location,
            'image'      => $imagePath,
            'description'=> $request->description,
        ]);

        // Broadcast activity
        $activity = Activity::create([
            'message' => 'New update published: ' . $update->event_name,
            'icon' => 'fas fa-calendar',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->route('admin.create_updates')->with('success', 'Update published successfully.');
    }

    /**
     * Delete an existing update and its image if exists.
     */
    public function destroy($id)
    {
        $update = Update::findOrFail($id);

        if ($update->image) {
            Storage::disk('public')->delete($update->image);
        }

        $update->delete();

        // Broadcast activity
        $activity = Activity::create([
            'message' => 'Update removed: ' . $update->event_name,
            'icon' => 'fas fa-trash',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->route('admin.create_updates')->with('success', 'Update removed successfully.');
    }
}
