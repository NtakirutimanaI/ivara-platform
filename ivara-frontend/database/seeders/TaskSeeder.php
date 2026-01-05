<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Task::create([
            'title' => 'Review Maintenance Logs',
            'description' => 'Check the weekly maintenance logs for the main facility.',
            'status' => 'pending',
            'user_id' => 1
        ]);

        \App\Models\Task::create([
            'title' => 'Inventory Audit',
            'description' => 'Perform a full audit of the technical repair spare parts.',
            'status' => 'in_progress',
            'user_id' => 1
        ]);

        \App\Models\Task::create([
            'title' => 'Team Briefing',
            'description' => 'Daily briefing with technicians on project schedules.',
            'status' => 'completed',
            'user_id' => 1
        ]);
    }
}
