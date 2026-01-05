<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MediaEntertainmentUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Audience Member Ann',
                'username' => 'consumer',
                'email' => 'consumer@media.com',
                'password' => Hash::make('password'),
                'role' => 'media_consumer',
                'phone' => '0789400000',
                'status' => 'active',
            ],
            [
                'name' => 'Artist Alex',
                'username' => 'creator',
                'email' => 'creator@media.com',
                'password' => Hash::make('password'),
                'role' => 'media_creator',
                'phone' => '0789400001',
                'status' => 'active',
            ],
            [
                'name' => 'Studio Prime',
                'username' => 'producer',
                'email' => 'producer@media.com',
                'password' => Hash::make('password'),
                'role' => 'media_producer',
                'phone' => '0789400002',
                'status' => 'active',
            ],
            [
                'name' => 'Ad Agency Pro',
                'username' => 'advertiser',
                'email' => 'advertiser@media.com',
                'password' => Hash::make('password'),
                'role' => 'media_advertiser',
                'phone' => '0789400003',
                'status' => 'active',
            ],
            [
                'name' => 'Global Stream TV',
                'username' => 'distributor',
                'email' => 'distributor@media.com',
                'password' => Hash::make('password'),
                'role' => 'media_distributor',
                'phone' => '0789400004',
                'status' => 'active',
            ],
            [
                'name' => 'Media Admin Mary',
                'username' => 'mediaadmin',
                'email' => 'mediaadmin@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'media_admin',
                'phone' => '0789400005',
                'status' => 'active',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(['email' => $userData['email']], $userData);
            $user->assignRole($userData['role']);
        }
    }
}
