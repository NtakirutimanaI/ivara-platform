<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cleanup existing users to prevent duplicates during testing re-seeds
        User::whereIn('username', [
            'super_admin', 'admin', 'technical_admin', 'manager', 'supervisor', 
            'technician', 'mechanic', 'electrician', 'builder', 'tailor', 
            'mediator', 'craftsperson', 'business'
        ])->delete();

        User::whereIn('email', [
            'superadmin@ivara.com', 'admin@ivara.com', 'technical_admin@ivara.com',
            'manager@ivara.com', 'supervisor@ivara.com', 'technician@ivara.com',
            'mechanic@ivara.com', 'electrician@ivara.com', 'builder@ivara.com',
            'tailor@ivara.com', 'mediator@ivara.com', 'craftsperson@ivara.com',
            'business@ivara.com'
        ])->delete();

        // 1. Super Admin
        $superAdmin = User::updateOrCreate(
            ['username' => 'super_admin'],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@ivara.com',
                'role' => 'super_admin',
                'password' => Hash::make('password'),
                'phone' => '0000000000',
                'country_code' => '+1',
            ]
        );
        $superAdmin->assignRole('super_admin');
        
        // 2. Standard Admin
        $admin = User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Standard Admin',
                'email' => 'admin@ivara.com',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'phone' => '0000000001',
                'country_code' => '+1',
            ]
        );
        $admin->assignRole('admin');

        // 3. Technical & Repair Roles
        $users = [
            ['role' => 'technical_admin', 'name' => 'Technical Admin', 'email' => 'technical_admin@ivara.com'],
            ['role' => 'manager', 'name' => 'Technical Manager', 'email' => 'manager@ivara.com'],
            ['role' => 'supervisor', 'name' => 'Site Supervisor', 'email' => 'supervisor@ivara.com'],
            ['role' => 'technician', 'name' => 'Senior Technician', 'email' => 'technician@ivara.com'],
            ['role' => 'mechanic', 'name' => 'Master Mechanic', 'email' => 'mechanic@ivara.com'],
            ['role' => 'electrician', 'name' => 'Expert Electrician', 'email' => 'electrician@ivara.com'],
            ['role' => 'builder', 'name' => 'Pro Builder', 'email' => 'builder@ivara.com'],
            ['role' => 'tailor', 'name' => 'Fashion Tailor', 'email' => 'tailor@ivara.com'],
            ['role' => 'mediator', 'name' => 'Service Mediator', 'email' => 'mediator@ivara.com'],
            ['role' => 'craftsperson', 'name' => 'Artisan Crafter', 'email' => 'craftsperson@ivara.com'],
            ['role' => 'business', 'name' => 'Business Owner', 'email' => 'business@ivara.com'],
        ];

        foreach ($users as $index => $u) {
            $user = User::updateOrCreate(
                ['username' => $u['role']],
                [
                    'name' => $u['name'],
                    'email' => $u['email'],
                    'role' => $u['role'],
                    'phone' => '12345678' . $index,
                    'country_code' => '+1',
                    'password' => Hash::make('password'),
                ]
            );
            $user->assignRole($u['role']);
        }
    }
}
