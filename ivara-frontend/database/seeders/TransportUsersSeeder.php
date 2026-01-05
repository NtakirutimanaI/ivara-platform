<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TransportUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Taxi Driver Joe',
                'username' => 'taxidriver',
                'email' => 'taxidriver@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'taxi_driver',
                'phone' => '0780000001',
                'status' => 'active',
            ],
            [
                'name' => 'Moto Rider Sam',
                'username' => 'motodriver',
                'email' => 'motodriver@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'motorcycle_taxi',
                'phone' => '0780000002',
                'status' => 'active',
            ],
            [
                'name' => 'Bus Driver Bill',
                'username' => 'busdriver',
                'email' => 'busdriver@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'bus_driver',
                'phone' => '0780000003',
                'status' => 'active',
            ],
            [
                'name' => 'Tour Guide Tom',
                'username' => 'tourdriver',
                'email' => 'tourdriver@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'tour_driver',
                'phone' => '0780000004',
                'status' => 'active',
            ],
            [
                'name' => 'Delivery Dan',
                'username' => 'deliverydriver',
                'email' => 'deliverydriver@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'delivery_driver',
                'phone' => '0780000005',
                'status' => 'active',
            ],
            [
                'name' => 'Emergency Eric',
                'username' => 'specialtransport',
                'email' => 'specialtransport@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'special_transport',
                'phone' => '0780000006',
                'status' => 'active',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(['email' => $userData['email']], $userData);
            $user->assignRole($userData['role']);
        }
    }
}
