<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Update;
use Carbon\Carbon;

class UpdatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 sample updates manually
        Update::create([
            'event_name' => 'System Maintenance',
            'date' => Carbon::now()->addDays(3)->toDateString(),
            'location' => 'Online',
            'image' => null,
            'description' => 'Scheduled maintenance for the platform.',
        ]);
        Update::create([
            'event_name' => 'New Feature Release',
            'date' => Carbon::now()->addDays(7)->toDateString(),
            'location' => 'Online',
            'image' => null,
            'description' => 'Introducing a new dashboard for analytics.',
        ]);
        Update::create([
            'event_name' => 'Community Webinar',
            'date' => Carbon::now()->addDays(10)->toDateString(),
            'location' => 'Zoom',
            'image' => null,
            'description' => 'Join us for a live webinar on best practices.',
        ]);
        Update::create([
            'event_name' => 'Partner Integration',
            'date' => Carbon::now()->addDays(14)->toDateString(),
            'location' => 'Online',
            'image' => null,
            'description' => 'Integrating with new partner services.',
        ]);
        Update::create([
            'event_name' => 'Holiday Support',
            'date' => Carbon::now()->addDays(20)->toDateString(),
            'location' => 'Online',
            'image' => null,
            'description' => 'Extended support hours during holidays.',
        ]);
    }
}
