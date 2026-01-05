<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AgricultureUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Farmer John',
                'username' => 'farmer',
                'email' => 'farmer@agri.com',
                'password' => Hash::make('password'),
                'role' => 'farmer',
                'phone' => '0780000030',
                'status' => 'active',
            ],
            [
                'name' => 'Green Acres Farm',
                'username' => 'farmmanager',
                'email' => 'manager@agri.com',
                'password' => Hash::make('password'),
                'role' => 'agri_manager',
                'phone' => '0780000031',
                'status' => 'active',
            ],
            [
                'name' => 'Agri-Seeds Ltd',
                'username' => 'agrisupplier',
                'email' => 'supplier@agri.com',
                'password' => Hash::make('password'),
                'role' => 'input_supplier',
                'phone' => '0780000032',
                'status' => 'active',
            ],
            [
                'name' => 'Officer Claire',
                'username' => 'extensionofficer',
                'email' => 'officer@agri.com',
                'password' => Hash::make('password'),
                'role' => 'extension_officer',
                'phone' => '0780000033',
                'status' => 'active',
            ],
            [
                'name' => 'Global Harvest Traders',
                'username' => 'producebuyer',
                'email' => 'buyer@agri.com',
                'password' => Hash::make('password'),
                'role' => 'produce_buyer',
                'phone' => '0780000034',
                'status' => 'active',
            ],
            [
                'name' => 'Eco-Watch Advisor',
                'username' => 'eco_officer',
                'email' => 'eco@agri.com',
                'password' => Hash::make('password'),
                'role' => 'sustainability_officer',
                'phone' => '0780000035',
                'status' => 'active',
            ],
            [
                'name' => 'Agri Admin Steve',
                'username' => 'agriadmin',
                'email' => 'agriadmin@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'agri_admin',
                'phone' => '0780000036',
                'status' => 'active',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(['email' => $userData['email']], $userData);
            $user->assignRole($userData['role']);
        }
    }
}
