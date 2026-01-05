<?php

namespace App\Http\Controllers\Categories\TechnicalRepair\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Feedback;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MediatorController extends Controller
{
    protected $api;

    public function __construct()
    {
        $this->api = new \App\Services\TechnicalRepairApiService();
    }

    public function index()
    {
        return $this->mediatorDashboard();
    }

    public function mediatorDashboard()
    {
        $user = Auth::user();
        $mediator_id = $user->id ?? session('user_id');

        // Fetch dashboard data from Backend API
        // Expected endpoint: /api/mediator/dashboard or individual stats
        // We will try to fetch a consolidated dashboard object first
        $response = $this->api->get("/mediator/{$mediator_id}/dashboard");

        if (empty($response)) {
            // Fallback or empty data if endpoint fails/not implemented yet
            $scheduledMeetings = 0;
            $newClients = 0;
            $unreadFeedback = 0;
            $recentBookings = [];
            $bookingsData = array_fill(0, 7, 0);
            $notificationData = (object)['email_count' => 0, 'sms_count' => 0, 'app_count' => 0];
        } else {
            $data = $response['data'] ?? $response;
            
            $scheduledMeetings = $data['scheduledMeetings'] ?? 0;
            $newClients = $data['newClients'] ?? 0;
            $unreadFeedback = $data['unreadFeedback'] ?? 0;
            $recentBookings = $data['recentBookings'] ?? [];
            $bookingsData = $data['bookingsData'] ?? array_fill(0, 7, 0); // Ensure array
            
            // Map notification data safely
            $notifyRaw = $data['notificationData'] ?? [];
            $notificationData = (object)[
                'email_count' => $notifyRaw['email_count'] ?? 0,
                'sms_count' => $notifyRaw['sms_count'] ?? 0,
                'app_count' => $notifyRaw['app_count'] ?? 0
            ];
        }

        return view('mediator.index', compact(
            'scheduledMeetings',
            'newClients',
            'unreadFeedback',
            'recentBookings',
            'bookingsData',
            'notificationData'
        ));
    }

    public function mediators()
    {
        return view('mediator.mediators');
    }

    public function clients()
    {
        return view('mediator.clients');
    }

    public function clientProducts()
    {
        return view('mediator.clients.products');
    }

    public function meetings()
    {
        return view('mediator.meetings');
    }
}
