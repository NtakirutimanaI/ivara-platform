<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ManagerClientsController extends Controller
{
    /**
     * Display a listing of clients with filters and pagination.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $perPage = $request->input('per_page', 10);

        $clientsQuery = User::where('role', 'client');

        if ($search) {
            $clientsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }

        if ($status) {
            $clientsQuery->where('status', $status);
        }

        $clients = $clientsQuery->orderBy('id', 'desc')->paginate($perPage);

        return view('manager.clients.index', compact('clients', 'search', 'status', 'perPage'));
    }

    /**
     * Store a newly created client in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'phone'        => 'nullable|string|max:20',
            'subscription' => 'nullable|string|max:50',
            'status'       => 'required|in:active,inactive,pending',
        ]);

        $client = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'subscription' => $request->subscription,
            'status'       => $request->status,
            'role'         => 'client',
            'password'     => bcrypt('password'), // default password
        ]);

        // Notification for new client
        DB::table('notifications')->insert([
            'notifiable_id'   => $client->id,
            'notifiable_type' => User::class,
            'data'            => json_encode(['message' => 'New client created: '.$client->name]),
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return redirect()->back()->with('success', 'Client added successfully.');
    }

    /**
     * Show a specific client (for modal view).
     */
    public function show($id)
    {
        $client = User::where('role', 'client')->findOrFail($id);
        return response()->json($client);
    }

    /**
     * Update the specified client.
     */
    public function update(Request $request, $id)
    {
        $client = User::where('role', 'client')->findOrFail($id);

        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,'.$client->id,
            'phone'        => 'nullable|string|max:20',
            'subscription' => 'nullable|string|max:50',
            'status'       => 'required|in:active,inactive,pending',
        ]);

        $client->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'subscription' => $request->subscription,
            'status'       => $request->status,
        ]);

        // Notification for update
        DB::table('notifications')->insert([
            'notifiable_id'   => $client->id,
            'notifiable_type' => User::class,
            'data'            => json_encode(['message' => 'Client updated: '.$client->name]),
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return redirect()->back()->with('success', 'Client updated successfully.');
    }

    /**
     * Delete a client.
     */
    public function destroy($id)
    {
        $client = User::where('role', 'client')->findOrFail($id);
        $client->delete();

        // Notification for deletion
        DB::table('notifications')->insert([
            'notifiable_id'   => $client->id,
            'notifiable_type' => User::class,
            'data'            => json_encode(['message' => 'Client deleted: '.$client->name]),
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return redirect()->back()->with('success', 'Client deleted successfully.');
    }

    /**
     * Change client status (Activate / Deactivate).
     */
    public function changeStatus($id)
    {
        $client = User::where('role', 'client')->findOrFail($id);
        $client->status = $client->status === 'active' ? 'inactive' : 'active';
        $client->save();

        // Notification for status change
        DB::table('notifications')->insert([
            'notifiable_id'   => $client->id,
            'notifiable_type' => User::class,
            'data'            => json_encode(['message' => 'Client status changed to: '.$client->status]),
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return redirect()->back()->with('success', 'Client status updated successfully.');
    }

    /**
     * Send a notification to a client (manual).
     */
    public function notify(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $client = User::where('role', 'client')->findOrFail($id);

        DB::table('notifications')->insert([
            'notifiable_id'   => $client->id,
            'notifiable_type' => User::class,
            'data'            => json_encode(['message' => $request->message]),
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return redirect()->back()->with('success', 'Notification sent successfully.');
    }
}
