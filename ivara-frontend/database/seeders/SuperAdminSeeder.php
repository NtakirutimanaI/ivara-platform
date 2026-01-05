<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@ivara.com'],
            [
                'name' => 'Super Administrator',
                'username' => 'superadmin',
                'role' => 'super_admin',
                'phone' => '0000000000',
                'country_code' => '+250',
                'password' => Hash::make('SuperAdmin123@'),
            ]
        );
    }
}
