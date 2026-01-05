<?php

namespace App\Modules\Core\Notification;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Notification;
use App\Events\ActivityCreated;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // -------------------- Notification Methods --------------------

    /**
     * Store a new notification
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id'   => 'required|exists:clients,id',
            'message'     => 'required|string|max:1000',
            'read_status' => 'required|boolean',
        ]);

        $notification = Notification::create([
            'client_id' => $request->client_id,
            'message' => $request->message,
            'is_read' => $request->read_status,
        ]);

        // Log activity
        $activity = Activity::create([
            'message' => "Notification sent to client ID: {$notification->client_id}",
            'icon' => 'fas fa-bell',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->back()->with('success', 'Notification added successfully.');
    }

    /**
     * Show SMS notifications page (example list)
     */
    public function notificationsSms()
    {
        $notifications = [
            ['id' => 1, 'recipient' => '+250788123456', 'message' => 'Your order has been shipped.', 'sent_at' => '2025-08-12 10:45:00'],
            ['id' => 2, 'recipient' => '+250788654321', 'message' => 'Payment received successfully.', 'sent_at' => '2025-08-12 11:20:00'],
        ];

        $activity = Activity::create([
            'message' => 'SMS notifications page viewed.',
            'icon' => 'fas fa-sms',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return view('admin.notifications_sms', compact('notifications'));
    }

    /**
     * Show main notifications page for authenticated user
     */
    public function index()
    {
        $user = Auth::user();

        $activity = Activity::create([
            'message' => "Notifications page viewed by {$user->name}.",
            'icon' => 'fas fa-bell',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        $notifications = Notification::where('user_id', $user->id)
            ->latest()
            ->paginate(15);

        return view('admin.notifications', compact('notifications'));
    }

    /**
     * Mark a single notification as read
     */
    public function markRead($id)
    {
        $user = Auth::user();

        $notification = Notification::where('user_id', $user->id)->findOrFail($id);
        $notification->update(['is_read' => true]);

        $activity = Activity::create([
            'message' => "Notification #{$id} marked as read by {$user->name}.",
            'icon' => 'fas fa-bell',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    /**
     * Delete a single notification
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $notification = Notification::where('user_id', $user->id)->findOrFail($id);
        $notification->delete();

        $activity = Activity::create([
            'message' => "Notification #{$id} deleted by {$user->name}.",
            'icon' => 'fas fa-trash',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }

    /**
     * Mark all notifications as read
     */
    public function markAllRead()
    {
        $user = Auth::user();

        Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $activity = Activity::create([
            'message' => "All notifications marked as read by {$user->name} (user ID: {$user->id}).",
            'icon' => 'fas fa-bell',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Show client-specific notifications page
     */
 
}
