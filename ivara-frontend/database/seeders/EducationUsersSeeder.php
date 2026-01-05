<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EducationUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Alice Student',
                'username' => 'student',
                'email' => 'student@edu.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'phone' => '0780000020',
                'status' => 'active',
            ],
            [
                'name' => 'Professor Smith',
                'username' => 'teacher',
                'email' => 'teacher@edu.com',
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'phone' => '0780000021',
                'status' => 'active',
            ],
            [
                'name' => 'Expert Tutor Tom',
                'username' => 'tutor',
                'email' => 'tutor@edu.com',
                'password' => Hash::make('password'),
                'role' => 'tutor',
                'phone' => '0780000022',
                'status' => 'active',
            ],
            [
                'name' => 'Content Author Ana',
                'username' => 'educontent',
                'email' => 'content@edu.com',
                'password' => Hash::make('password'),
                'role' => 'edu_content_creator',
                'phone' => '0780000023',
                'status' => 'active',
            ],
            [
                'name' => 'Kigali Tech Institute',
                'username' => 'institution',
                'email' => 'institution@edu.com',
                'password' => Hash::make('password'),
                'role' => 'institution_admin',
                'phone' => '0780000024',
                'status' => 'active',
            ],
            [
                'name' => 'Education Admin Bob',
                'username' => 'eduadmin',
                'email' => 'eduadmin@ivara.com',
                'password' => Hash::make('password'),
                'role' => 'edu_admin',
                'phone' => '0780000025',
                'status' => 'active',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(['email' => $userData['email']], $userData);
            $user->assignRole($userData['role']);
        }
    }
}
