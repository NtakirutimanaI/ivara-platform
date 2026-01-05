<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Message;
use App\Models\Activity;
use App\Models\Transaction;

class ClientController extends Controller
{
    // -------------------- Client Methods --------------------

    // Show client registration form (optional)
    public function index()
    {
        return view('client.index'); // Create this view if needed
    }

    // Client dashboard
    public function dashboard()
    {
        $client = auth()->user(); // get logged-in client

        // Optional: fetch client-related data
        $transactions = $client->transactions()->orderBy('created_at', 'desc')->get();

        return view('client.index', compact('client', 'transactions'));
    }

    // Handle client form submission and save client data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:25',
            'email'         => 'nullable|email|max:255',
            'address'       => 'nullable|string|max:255',
            'city'          => 'nullable|string|max:100',
            'country'       => 'nullable|string|max:100',
            'national_id'   => 'nullable|string|max:100',
            'gender'        => 'nullable|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'notes'         => 'nullable|string|max:500',
        ]);

        $client = Client::create($validated);

        session(['client_id' => $client->id]);

        return redirect()->route('register.step', ['step' => 2])
                         ->with('success', 'Client saved successfully! Now register Device.');
    }

    // Update client information (profile)
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255|unique:clients,email,' . $client->id,
            'phone'   => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'city'    => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'subscription' => 'nullable|in:basic,premium,vip',
            'status' => 'nullable|in:active,inactive,pending',
        ]);

        $client->update($request->only(['name','email','phone','address','city','country','subscription','status']));

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    // -------------------- Messaging --------------------
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'message'      => 'required|string|min:5',
        ]);

        $message = Message::create([
            'user_id'      => auth()->id(),
            'recipient_id' => $validated['recipient_id'],
            'message'      => $validated['message'],
        ]);

        createNotification(
            'message',
            'You have received a new message from ' . auth()->user()->name,
            $validated['recipient_id'],
            $message->id,
            'App\Models\Message'
        );

        Activity::create([
            'message' => 'Client sent a message to user ID: ' . $validated['recipient_id'],
            'icon'    => 'fas fa-envelope',
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    // -------------------- Supervisor Methods --------------------

    public function supervisorClients(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $perPage = $request->input('per_page', 10);

        $query = Client::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $clients = $query->paginate($perPage)->withQueryString();

        return view('supervisor.clients', compact('clients', 'search', 'status', 'perPage'));
    }

    public function supervisorStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients,email',
            'phone' => 'nullable|string|max:20',
            'subscription' => 'required|in:basic,premium,vip',
            'status' => 'required|in:active,inactive,pending',
        ]);

        Client::create($validated);

        return redirect()->back()->with('success', 'Client added successfully.');
    }

    public function supervisorShow(Client $client)
    {
        return response()->json($client);
    }

    public function supervisorUpdate(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'subscription' => 'required|in:basic,premium,vip',
            'status' => 'required|in:active,inactive,pending',
        ]);

        $client->update($validated);

        return redirect()->back()->with('success', 'Client updated successfully.');
    }

    public function supervisorChangeStatus(Client $client)
    {
        $client->status = $client->status === 'active' ? 'inactive' : 'active';
        $client->save();

        return redirect()->back()->with('success', 'Client status updated.');
    }

    public function supervisorNotify(Request $request, Client $client)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $client->notifications()->create([
            'message' => $request->message,
            'sent_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Notification sent to client.');
    }

    public function supervisorInvoice(Client $client)
    {
        return view('supervisor.invoice', compact('client'));
    }

    public function supervisorDestroy(Client $client)
    {
        $client->delete();

        return redirect()->back()->with('success', 'Client deleted successfully.');
    }

    // -------------------- Client Extra Views --------------------

    public function clientMeetings()
    {
        return view('client.meetings');
    }
        
    public function clientTechnicians()
    {
        return view('client.technicians');
    }

    // Filter client transactions (AJAX)
    public function filterTransactions(Request $request)
    {
        $transactions = Transaction::query()
            ->when($request->start_date, fn($q) => $q->whereDate('created_at', '>=', $request->start_date))
            ->when($request->end_date, fn($q) => $q->whereDate('created_at', '<=', $request->end_date))
            ->when($request->type, fn($q) => $q->where('type', $request->type))
            ->where('client_id', auth()->id())
            ->latest()
            ->get();

        return response()->json([
            'html' => view('client.partials.transactions_table', compact('transactions'))->render()
        ]);
    }



    public function devicesMaterials()
    {
        return view('client.devices_materials');
    }
     
     
}
