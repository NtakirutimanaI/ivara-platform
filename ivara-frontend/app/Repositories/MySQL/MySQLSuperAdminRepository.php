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

    public function getSystemOverview()
    {
        return [
            'total_users' => User::count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_managers' => User::where('role', 'manager')->count(),
            // Add more stats as needed (orders, bookings, etc.)
            // Assuming tables exist
            'total_orders' => \Illuminate\Support\Facades\Schema::hasTable('orders') ? DB::table('orders')->count() : 0,
        ];
    }
}
