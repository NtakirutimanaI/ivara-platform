<?php

namespace App\Modules\Core\Notification;

use App\Http\Controllers\Controller;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Events\ActivityCreated;

class SmsController extends Controller
{
    /**
     * Display the SMS page with contacts
     */
    public function index()
    {
        // Fetch contacts with pagination (10 per page)
        $contacts = Contact::latest()->paginate(10);

        // Broadcast activity for accessing SMS page
        $activity = Activity::create([
            'message' => 'Accessed SMS page.',
            'icon' => 'fas fa-sms',
        ]);
        broadcast(new ActivityCreated($activity))->toOthers();

        // Pass $contacts to the view
        return view('admin.sms', compact('contacts'));
    }
}
