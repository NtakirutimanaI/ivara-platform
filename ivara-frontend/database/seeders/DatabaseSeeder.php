<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminUserSeeder::class,
            TransportUsersSeeder::class,
            CreativeLifestyleUsersSeeder::class,
            FoodFashionUsersSeeder::class,
            EducationUsersSeeder::class,
            AgricultureUsersSeeder::class,
            MediaEntertainmentUsersSeeder::class,
            LegalProfessionalUsersSeeder::class,
            UserManagementSeeder::class,
            UpdatesTableSeeder::class,
        ]);
    }
}
