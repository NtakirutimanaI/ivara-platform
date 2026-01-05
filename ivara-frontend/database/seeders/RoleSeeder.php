<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'super_admin',
            'admin',
            'manager',
            'supervisor',
            'technical_admin',
            'technician',
            'mechanic',
            'electrician',
            'builder',
            'tailor',
            'mediator',
            'craftsperson',
            'business',
            'intern',
            'client',
            // Transport Roles
            'taxi_driver',
            'motorcycle_taxi',
            'bus_driver',
            'tour_driver',
            'delivery_driver',
            'special_transport',
            // Creative & Wellness Roles
            'multi_sports_academics',
            'gym_trainer',
            'fitness_coach',
            'yoga_trainer',
            'aerobics_instructor',
            'martial_arts_trainer',
            'pilates_instructor',
            // Food, Events & Fashion Roles
            'food_customer',
            'food_vendor',
            'event_organizer',
            'fashion_vendor',
            'food_delivery',
            'food_admin',
            // Education & Knowledge Roles
            'student',
            'teacher',
            'tutor',
            'edu_content_creator',
            'institution_admin',
            'edu_admin',
            // Agriculture & Environment Roles
            'farmer',
            'agri_manager',
            'input_supplier',
            'extension_officer',
            'produce_buyer',
            'sustainability_officer',
            'agri_admin',
            // Media & Entertainment Roles (Expanded)
            'media_consumer',
            'media_creator',
            'media_producer',
            'media_advertiser',
            'media_distributor',
            'media_admin',
            // Legal & Professional Services Roles (Expanded)
            'legal_client',
            'legal_pro',
            'professional_consultant',
            'legal_firm',
            'legal_regulator',
            'legal_admin',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }
    }
}
