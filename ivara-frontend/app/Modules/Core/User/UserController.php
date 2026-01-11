<?php

namespace App\Modules\Core\User;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = [];

        try {
            $baseUrl = env('BACKEND_API_URL', 'http://localhost:5001/api');
            $baseUrl = rtrim($baseUrl, '/');
            if (str_ends_with($baseUrl, '/api')) {
                $baseUrl = substr($baseUrl, 0, -4);
            }
            
            $url = "{$baseUrl}/api/auth/users-by-roles";
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . session('auth_token')])
                ->get($url, [
                    'roles' => $request->input('role', 'admin,manager,supervisor,user'),
                    'search' => $request->input('search'),
                    'status' => $request->input('status')
                ]);
            
            if ($response->successful()) {
                $users = $response->json();
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Admin User List API failed: ' . $e->getMessage());
        }

        // Mock roles for view
        $roles = [
            (object)['id' => 1, 'name' => 'admin'],
            (object)['id' => 2, 'name' => 'manager'],
            (object)['id' => 3, 'name' => 'supervisor'],
            (object)['id' => 4, 'name' => 'user']
        ];


        if ($request->ajax()) {
            return view('admin.partials.users_table', compact('users', 'roles'));
        }
        
        return view('admin.users', compact('users', 'roles'));
    }

    /**
     * Optional: Alias to index()
     */
    public function users()
    {
        return $this->index();
    }

    /**
     * Create and store a new user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username',
            'phone'         => 'required|string|max:20',
            'country_code'  => 'nullable|string|max:10',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|string|min:6|confirmed',
            'roles'         => 'nullable|array',
            'roles.*'       => 'exists:roles,name',
        ]);

        $user = User::create([
            'name'         => $request->name,
            'username'     => $request->username,
            'phone'        => $request->phone,
            'country_code' => $request->country_code,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
        ]);

        if ($request->filled('roles')) {
            $user->syncRoles($request->roles); // assign multiple roles by name
        }

        return redirect()->route('admin.users.index')->with('success', 'User added successfully.');
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update existing user.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'          => 'required',
            'username'      => 'required|unique:users,username,' . $user->id,
            'phone'         => 'required',
            'country_code'  => 'nullable',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'password'      => 'nullable|min:6',
            'roles'         => 'nullable|array',
            'roles.*'       => 'exists:roles,name',
        ]);

        $user->update([
            'name'         => $request->name,
            'username'     => $request->username,
            'phone'        => $request->phone,
            'country_code' => $request->country_code,
            'email'        => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        if ($request->filled('roles')) {
            $user->syncRoles($request->roles); // update user roles
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Toggle active/inactive status.
     */
    public function toggleStatus(User $user)
    {
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully.');
    }

    /**
     * Change user role by name (overwrites existing roles).
     */
    public function changeRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'User role updated successfully.');
    }

    /**
     * Assign multiple roles by ID (optional use of role IDs).
     */
    public function assignRolesById(Request $request, $userId)
    {
        $request->validate([
            'role_ids'   => 'required|array',
            'role_ids.*' => 'exists:roles,id',
        ]);

        $user = User::findOrFail($userId);
        $user->roles()->sync($request->role_ids);

        return back()->with('success', 'Roles assigned by ID successfully.');
    }

    /**
     * Paginated user fetcher.
     */
   

    public function user()
    {
        $users = User::paginate(10);
        $roles = Role::all(); // fetch roles

        return view('admin.users', compact('users', 'roles'));
    }
    
  

    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'User password has been reset successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);
        User::whereIn('id', $request->ids)->delete();
        return response()->json(['success' => true]);
    }

    public function bulkStatus(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'status' => 'required|in:active,inactive'
        ]);
        User::whereIn('id', $request->ids)->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }

    public function export(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $format = $request->input('format', 'csv');

        $query = User::query();

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $users = $query->latest()->get();

        if ($format === 'pdf') {
            $pdf = \PDF::loadView('admin.reports.users_pdf', compact('users', 'startDate', 'endDate'));
            return $pdf->download('users_report_' . date('Y-m-d') . '.pdf');
        }

        // CSV Export
        $filename = "users_export_" . date('Y-m-d') . ".csv";
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        fputcsv($handle, ['ID', 'Name', 'Username', 'Email', 'Phone', 'Role', 'Status', 'Joined']);

        foreach ($users as $user) {
            fputcsv($handle, [
                $user->id,
                $user->name,
                $user->username,
                $user->email,
                $user->phone,
                $user->getRoleNames()->implode(', '),
                $user->status,
                $user->created_at->format('Y-m-d')
            ]);
        }

        fclose($handle);
        exit;
    }
}
