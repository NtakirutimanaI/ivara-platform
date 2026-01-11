<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class HeaderApiController extends Controller
{
    public function notifications(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['unread_count' => 0, 'latest' => []]);
        }

        $unreadCount = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();

        $latest = Notification::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return response()->json([
            'unread_count' => $unreadCount,
            'latest' => $latest
        ]);
    }

    public function messages(Request $request)
    {
        // Placeholder for now as Messaging system is not fully defined
        return response()->json([
            'unread_count' => 0,
            'latest' => []
        ]);
    }
}
