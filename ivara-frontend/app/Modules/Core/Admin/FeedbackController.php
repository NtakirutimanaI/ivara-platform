<?php

namespace App\Modules\Core\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;
use App\Models\FeedbackReply;
use App\Models\Activity;
use App\Events\ActivityCreated;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class FeedbackController extends Controller
{
    /**
     * Allowed roles reference (used in views).
     */
    protected $roles = [
        'admin', 'manager', 'supervisor', 'technician', 'mechanic',
        'craftsperson', 'businessperson', 'tailor', 'mediator', 'client'
    ];

    /**
     * Admin: List and filter feedbacks.
     */
    public function index(Request $request)
    {
        $query = Feedback::query();

        if ($request->filled('search')) {
            $query->where('message', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('user_type')) {
            $query->where('user_type', $request->user_type);
        }

        if ($request->filled('urgency')) {
            $query->where('urgency', $request->urgency);
        }

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        $feedbacks = $query->latest()->paginate(10);

        return view('admin.feedback', compact('feedbacks'));
    }

    /**
     * Admin: Reply to a feedback entry.
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        FeedbackReply::create([
            'feedback_id' => $id,
            'reply' => $request->reply,
            'admin_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Reply sent.');
    }

    /**
     * Admin: Export feedback to Excel or PDF.
     */
    public function export($type)
    {
        if ($type === 'excel') {
            return Excel::download(new Feedback, 'feedback.xlsx');
        }

        if ($type === 'pdf') {
            $data = Feedback::all();
            $pdf = PDF::loadView('admin.export_pdf', compact('data'));
            return $pdf->download('feedback.pdf');
        }

        return redirect()->back()->with('error', 'Invalid export type.');
    }

    /**
     * Client: Show feedback submission form.
     */
    public function create()
    {
        return view('feedback.create', ['roles' => $this->roles]);
    }

    /**
     * Client: Store feedback from frontend.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('client')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'user_type'   => 'required|string|max:100',
            'module'      => 'required|string|max:100',
            'urgency'     => 'required|string|in:Low,Normal,High,Critical',
            'category'    => 'required|string|max:100',
            'message'     => 'required|string|max:1000',
            'name'        => 'nullable|string|max:255',
            'email'       => 'nullable|email|max:255',
            'anonymous'   => 'nullable|boolean',
            'attachment'  => 'nullable|file|max:2048|mimes:jpg,jpeg,png,pdf,doc,docx',
        ]);

        if ($request->boolean('anonymous')) {
            $validated['name'] = null;
            $validated['email'] = null;
            $validated['anonymous'] = true;
        }

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('feedback_attachments', 'public');
            $validated['attachment'] = $path;
        }

        $validated['user_id'] = $user->id;

        $feedback = Feedback::create($validated);

        // Log activity
        $activity = Activity::create([
            'message' => 'New feedback submitted by ' . ($user->name ?? 'Anonymous'),
            'icon'    => 'fas fa-comment-dots',
        ]);

        // Broadcast activity to others
        broadcast(new ActivityCreated($activity))->toOthers();

        if ($request->wantsJson()) {
            return response()->json(['success' => 'Feedback submitted successfully']);
        }

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

     public function clientFeedback()
    {
        return "Client User Feedback page";
    }
}
