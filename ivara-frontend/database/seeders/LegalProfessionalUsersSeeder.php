<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LegalProfessionalUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Client Caleb',
                'username' => 'legalclient',
                'email' => 'client@legal.com',
                'password' => Hash::make('password'),
                'role' => 'legal_client',
                'phone' => '0789500000',
                'status' => 'active',
            ],
            [
                'name' => 'Advocate Alice',
                'username' => 'legalpro',
                'email' => 'pro@legal.com',
                'password' => Hash::make('password'),
                'role' => 'legal_pro',
                'phone' => '0789500001',
                'status' => 'active',
            ],
            [
                'name' => 'Expert Consultant Ed',
                'username' => 'consultant',
                'email' => 'consultant@legal.com',
                'password' => Hash::make('password'),
                'role' => 'professional_consultant',
                'phone' => '0789500002',
                'status' => 'active',
            ],
            [
                'name' => 'Kigali Law Firm',
                'username' => 'legalfirm',
                'email' => 'firm@legal.com',
                'password' => Hash::make('password'),
                'role' => 'legal_firm',
                'phone' => '0789500003',
                'status' => 'active',
            ],
            [
                'name' => 'Compliance Board',
                'username' => 'regulator',
                'email' => 'regulator@legal.com',
                'password' => Hash::make('password'),
                'role' => 'legal_regulator',
                'phone' => '0789500004',
                'status' => 'active',
            ],
            [
                'name' => 'Legal Admin Linda',
                'username' => 'legaladmin',
                'email' => 'legaladmin@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'legal_admin',
                'phone' => '0789500005',
                'status' => 'active',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(['email' => $userData['email']], $userData);
            $user->assignRole($userData['role']);
        }
    }
}
