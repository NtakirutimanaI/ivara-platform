<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Activity::create([
            'title' => 'System Update',
            'description' => 'Security patches applied to the main server.',
            'status' => 'completed',
            'user_id' => 1
        ]);

        \App\Models\Activity::create([
            'title' => 'New Client Registered',
            'description' => 'Client "John Doe" has joined the platform.',
            'status' => 'info',
            'user_id' => 1
        ]);

        \App\Models\Activity::create([
            'title' => 'Repair Completed',
            'description' => 'Repair #1024 (iPhone 13) is ready for pickup.',
            'status' => 'success',
            'user_id' => 1
        ]);
    }
}
