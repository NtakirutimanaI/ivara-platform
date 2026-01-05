<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OtherServicesUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Other Services Admin',
                'username' => 'otheradmin',
                'email' => 'other.admin@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '0789600000',
                'status' => 'active',
                'category' => 'other-services', // Explicit category assignment
            ],
            [
                'name' => 'Other Services Manager',
                'username' => 'othermanager',
                'email' => 'other.manager@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'phone' => '0789600001',
                'status' => 'active',
                'category' => 'other-services',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(['email' => $userData['email']], $userData);
            $user->assignRole($userData['role']);
        }
    }
}
