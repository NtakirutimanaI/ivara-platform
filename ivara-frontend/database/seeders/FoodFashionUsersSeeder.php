<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FoodFashionUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Foodie Frank',
                'username' => 'foodcustomer',
                'email' => 'customer@food.com',
                'password' => Hash::make('password'),
                'role' => 'food_customer',
                'phone' => '0780000014',
                'status' => 'active',
            ],
            [
                'name' => 'Mama Africa Restaurant',
                'username' => 'foodvendor',
                'email' => 'vendor@food.com',
                'password' => Hash::make('password'),
                'role' => 'food_vendor',
                'phone' => '0780000015',
                'status' => 'active',
            ],
            [
                'name' => 'Events by Eve',
                'username' => 'eventorganizer',
                'email' => 'events@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'event_organizer',
                'phone' => '0780000016',
                'status' => 'active',
            ],
            [
                'name' => 'Fashion House Kigali',
                'username' => 'fashionvendor',
                'email' => 'fashion@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'fashion_vendor',
                'phone' => '0780000017',
                'status' => 'active',
            ],
            [
                'name' => 'Ivury Logistics',
                'username' => 'fooddelivery',
                'email' => 'delivery@food.com',
                'password' => Hash::make('password'),
                'role' => 'food_delivery',
                'phone' => '0780000018',
                'status' => 'active',
            ],
            [
                'name' => 'Food Admin Dave',
                'username' => 'foodadmin',
                'email' => 'foodadmin@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'food_admin',
                'phone' => '0780000019',
                'status' => 'active',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(['email' => $userData['email']], $userData);
            $user->assignRole($userData['role']);
        }
    }
}
