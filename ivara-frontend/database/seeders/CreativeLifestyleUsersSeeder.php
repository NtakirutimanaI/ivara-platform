<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreativeLifestyleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Sports Academy Admin',
                'username' => 'sportsacademy',
                'email' => 'sportsacademy@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'multi_sports_academics',
                'phone' => '0780000007',
                'status' => 'active',
            ],
            [
                'name' => 'Gym Trainer Jack',
                'username' => 'gymtrainer',
                'email' => 'gymtrainer@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'gym_trainer',
                'phone' => '0780000008',
                'status' => 'active',
            ],
            [
                'name' => 'Fitness Coach Fox',
                'username' => 'fitnesscoach',
                'email' => 'fitnesscoach@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'fitness_coach',
                'phone' => '0780000009',
                'status' => 'active',
            ],
            [
                'name' => 'Yoga Guru Zen',
                'username' => 'yogatrainer',
                'email' => 'yogatrainer@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'yoga_trainer',
                'phone' => '0780000010',
                'status' => 'active',
            ],
            [
                'name' => 'Aerobics Queen',
                'username' => 'aerobicsinstructor',
                'email' => 'aerobics@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'aerobics_instructor',
                'phone' => '0780000011',
                'status' => 'active',
            ],
            [
                'name' => 'Sensei Lee',
                'username' => 'martialartstrainer',
                'email' => 'martialarts@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'martial_arts_trainer',
                'phone' => '0780000012',
                'status' => 'active',
            ],
            [
                'name' => 'Pilates Pro Pam',
                'username' => 'pilatesinstructor',
                'email' => 'pilates@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'pilates_instructor',
                'phone' => '0780000013',
                'status' => 'active',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(['email' => $userData['email']], $userData);
            $user->assignRole($userData['role']);
        }
    }
}
