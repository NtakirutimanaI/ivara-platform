<?php

namespace App\Repositories\MySQL;

use App\Contracts\Repositories\SuperAdminRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MySQLSuperAdminRepository implements SuperAdminRepositoryInterface
{
    public function getAllAdmins()
    {
        return User::whereIn('role', ['admin', 'manager', 'supervisor'])->get();
    }

    public function createAdmin(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function updateAdmin($id, array $data)
    {
        $user = User::findOrFail($id);
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        return $user;
    }

    public function deleteAdmin($id)
    {
        return User::destroy($id);
    }

    public function getUsersByRole(array $roles)
    {
        return User::whereIn('role', $roles)->get();
    }

    public function getSystemOverview()
    {
        return [
            'total_users' => User::count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_managers' => User::where('role', 'manager')->count(),
            'total_supervisors' => User::where('role', 'supervisor')->count(),
            'online_admins' => User::where('role', 'admin')->where('status', 'online')->count(),
            'online_managers' => User::where('role', 'manager')->where('status', 'online')->count(),
            'online_supervisors' => User::where('role', 'supervisor')->where('status', 'online')->count(),
            'total_providers' => User::whereIn('role', ['provider', 'Provider'])->count(),
            'total_clients' => User::whereIn('role', ['client', 'Client'])->count(),
            'pending_verifications' => User::where('status', 'pending')->orWhere('status', 'inactive')->count(),
            'total_orders' => \Illuminate\Support\Facades\Schema::hasTable('orders') ? DB::table('orders')->count() : 0,
        ];
    }

    public function findUserById($id)
    {
        return User::findOrFail($id);
    }

    public function updateUserStatus($id, $status)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => $status]);
        return $user;
    }
}
