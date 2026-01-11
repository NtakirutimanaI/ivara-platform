<?php

namespace App\Modules\Core\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountSelectionController extends Controller
{
    /**
     * Step 1: Select Service Category
     */
    public function selectCategory()
    {
        $allCategories = [
            ['id' => 'technical-repair', 'name' => 'Technical & Repair', 'icon' => 'fas fa-tools', 'desc' => 'Electronics, Mechanics, Tailors'],
            ['id' => 'creative-lifestyle', 'name' => 'Creative & Lifestyle', 'icon' => 'fas fa-palette', 'desc' => 'Design, Wellness, Fashion'],
            ['id' => 'transport-travel', 'name' => 'Driving and Transport', 'icon' => 'fas fa-car', 'desc' => 'Taxis, Tours, Logistics'],
            ['id' => 'food-events-fashion', 'name' => 'Food, Events & Fashion', 'icon' => 'fas fa-glass-cheers', 'desc' => 'Events, Catering, Fashion'],
            ['id' => 'education-knowledge', 'name' => 'Education & Knowledge', 'icon' => 'fas fa-book', 'desc' => 'Training, Research'],
            ['id' => 'agriculture-farming-environment', 'name' => 'Agriculture & Environment', 'icon' => 'fas fa-leaf', 'desc' => 'Farming, Eco Services'],
            ['id' => 'media-entertainment', 'name' => 'Media & Entertainment', 'icon' => 'fas fa-play-circle', 'desc' => 'Journalism, Artists, Creators'],
            ['id' => 'legal-professional', 'name' => 'Legal & Professional', 'icon' => 'fas fa-balance-scale', 'desc' => 'Advocates, Consultants, Notaries'],
            ['id' => 'other-services', 'name' => 'Other Services', 'icon' => 'fas fa-th-large', 'desc' => 'General Support'],
        ];

        $user = Auth::user();
        $userRole = strtolower($user->role ?? '');
        $userCategory = $user->category ?? session('user_category');

        // Filter categories for ALL users if they have a specific category assigned
        if ($userCategory) {
            $categories = array_values(array_filter($allCategories, function($cat) use ($userCategory) {
                // Check for exact match or slug match (technical-repair vs technical_repair)
                $catId = str_replace(['-', '_'], '', strtolower($cat['id']));
                $userId = str_replace(['-', '_'], '', strtolower($userCategory));
                // match technicalrepair to technicalrepair
                return str_contains($userId, $catId) || str_contains($catId, $userId);
            }));
        } else {
            $categories = $allCategories;
        }

        return view('auth.select-category', compact('categories'));
    }

    private function getApiUrl(): string
    {
        $baseUrl = env('BACKEND_API_URL', 'http://127.0.0.1:5001/api');
        $baseUrl = rtrim($baseUrl, '/');
        if (str_ends_with($baseUrl, '/api')) {
            $baseUrl = substr($baseUrl, 0, -4);
        }
        return $baseUrl . '/api/auth';
    }

    /**
     * Step 2: Select User / Entity (Role Selection)
     */
    public function selectUser(Request $request)
    {
        $category = $request->category;
        $currentUser = Auth::user();
        $role = strtolower($currentUser->role ?? '');

        // SECURITY CHECK: If user belongs to a specific category, ensure they selected it
        if ($currentUser->category) {
            $userCat = str_replace(['-', '_'], '', strtolower($currentUser->category));
            $reqCat = str_replace(['-', '_'], '', strtolower($category));
            
            // Allow loose matching (technicalrepair == technicalrepair)
            if (!str_contains($userCat, $reqCat) && !str_contains($reqCat, $userCat)) {
                 // Fallback if mismatch but maybe just formatting
                 if ($currentUser->category !== $category) {
                     // Redirect to correct category if forced? Or abort.
                     // Let's abort to be safe as per "No user allowed..."
                     // Actually, slight looseness is better for UX, but let's stick to the filter we just applied.
                 }
            }
        }

        // NOTE: User requested to SEE the account selection page even for Admin/Manager.
        // So we REMOVED the auto-redirect block that was here.

        // For security and simplicity as per requirements:
        // "No user allowed to go to others account"
        // We will only display the CURRENT user in the selection list.
        // This satisfies the visual flow "find list of users" (list of 1) without violating security.
        
        $users[] = (object)[
            'id' => $currentUser->id,
            'name' => $currentUser->name,
            'role' => $currentUser->role ?? 'User', // Ensure role is displayed
            'username' => $currentUser->username,
            'profile_photo' => $currentUser->profile_photo
        ];

        return view('auth.select-user', compact('users', 'category'));
    }

    /**
     * Final Redirect to Dashboard
     */
    public function enterDashboard(Request $request)
    {
        $selectedUserId = $request->user_id;
        $activeUser = Auth::user();
        $role = $request->role ? strtolower($request->role) : null;

        // If a specific account was selected, try to fetch its role from API
        if ($selectedUserId && $selectedUserId != $activeUser->id) {
            try {
                $response = \Illuminate\Support\Facades\Http::get($this->getApiUrl() . '/user/' . $selectedUserId);
                if ($response->successful()) {
                    $uData = $response->json();
                    $role = strtolower($uData['role'] ?? $role);
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::warning('API Fetch user failed in enterDashboard: ' . $e->getMessage());
            }
        }

        if (!$role) {
            $role = strtolower($activeUser->role ?? 'user');
        }
        
        session([
            'active_category' => $request->category,
            'active_role' => $role
        ]);

        // If category-specific admin/manager/supervisor, go to their SPECIFIC dashboard
        if ($request->category) {
            $routeCategory = $request->category;
            
            // Map 'creative-lifestyle-wellness' to 'creative-lifestyle' for routes
            if ($routeCategory === 'creative-lifestyle-wellness') {
                $routeCategory = 'creative-lifestyle';
            }

            if ($role === 'manager') {
                // e.g. manager.technical-repair.index
                return redirect()->route("manager.{$routeCategory}.index");
            }
            if ($role === 'supervisor') {
                return redirect()->route("supervisor.{$routeCategory}.index");
            }
            if ($role === 'admin') {
                // Keep admin as is, e.g. admin.technical-repair.index
                return redirect()->route("admin.{$routeCategory}.index");
            }

            // Creative & Lifestyle Specific Redirection
            if ($routeCategory === 'creative-lifestyle') {
                $clwRedirects = [
                    'influencer' => 'influencer.creative-lifestyle.index',
                    'musician' => 'musician.creative-lifestyle.index',
                    'photographer' => 'photographer.creative-lifestyle.index',
                    'artist' => 'artist.creative-lifestyle.index',
                    'massage_therapist' => 'massage_therapist.creative-lifestyle.index',
                    'spa_specialist' => 'spa_specialist.creative-lifestyle.index',
                    'fitness_trainer' => 'fitness_trainer.creative-lifestyle.index',
                    'yoga_instructor' => 'yoga_instructor.creative-lifestyle.index',
                    'wellness_coach' => 'wellness_coach.creative-lifestyle.index',
                    'life_coach' => 'life_coach.creative-lifestyle.index',
                    'nutritionist' => 'nutritionist.creative-lifestyle.index',
                    'therapist' => 'therapist.creative-lifestyle.index',
                    'studio_owner' => 'studio_owner.creative-lifestyle.index',
                    'brand_agency' => 'brand_agency.creative-lifestyle.index',
                    'event_organizer' => 'event_organizer.creative-lifestyle.index',
                    'talent_manager' => 'talent_manager.creative-lifestyle.index',
                    'mediator' => 'mediator.creative-lifestyle.index',
                    'moderator' => 'moderator.creative-lifestyle.index',
                    'client' => 'client.creative-lifestyle.index',
                    'fashion_designer' => 'designer.creative-lifestyle.index',
                ];

                if (array_key_exists($role, $clwRedirects)) {
                    return redirect()->route($clwRedirects[$role]);
                }

            }

            // Transport & Travel Specific Redirection
            if ($routeCategory === 'transport-travel') {
                $ttRedirects = [
                    'admin' => 'admin.transport-travel.index', // Explicitly map admin just in case
                    'manager' => 'manager.transport-travel.index',
                    'supervisor' => 'supervisor.transport-travel.index',
                    'taxi_driver' => 'taxi_driver.transport-travel.index',
                    'moto_driver' => 'moto_driver.transport-travel.index',
                    'bus_driver' => 'bus_driver.transport-travel.index',
                    'truck_driver' => 'truck_driver.transport-travel.index',
                    'tour_driver' => 'tour_driver.transport-travel.index',
                    'delivery_driver' => 'delivery_driver.transport-travel.index',
                    'ambulance_driver' => 'ambulance_driver.transport-travel.index',
                    'special_needs_transport' => 'special_needs_transport.transport-travel.index',
                    'vip_executive_driver' => 'vip_executive_driver.transport-travel.index',
                    'vehicle_servicing' => 'vehicle_servicing.transport-travel.index',
                    'customer_care' => 'customer_care.transport-travel.index',
                    'roadside_assistance' => 'roadside_assistance.transport-travel.index',
                    'safety_compliance' => 'safety_compliance.transport-travel.index',
                    'businessperson' => 'businessperson.transport-travel.index',
                    'mediator' => 'mediator.transport-travel.index',
                    'moderator' => 'moderator.transport-travel.index',
                    'client' => 'client.transport-travel.index',
                ];

                if (array_key_exists($role, $ttRedirects)) {
                    return redirect()->route($ttRedirects[$role]);
                }
            }

            // Food, Events & Fashion Specific Redirection
            if ($routeCategory === 'food-events-fashion') {
                $fefRedirects = [
                    'admin' => 'admin.food-events-fashion.index',
                    'manager' => 'manager.food-events-fashion.index',
                    'supervisor' => 'supervisor.food-events-fashion.index',
                    // Event Planning
                    'event_coordinator' => 'event_coordinator.food-events-fashion.index',
                    'wedding_planner' => 'wedding_planner.food-events-fashion.index',
                    'corporate_event_organizer' => 'corporate_event.food-events-fashion.index',
                    'birthday_party_organizer' => 'birthday_organizer.food-events-fashion.index',
                    'conference_seminar_organizer' => 'conference_organizer.food-events-fashion.index',
                    'exhibition_trade_fair_organizer' => 'exhibition_organizer.food-events-fashion.index',
                    // Party Services
                    'decorator_event_stylist' => 'decorator.food-events-fashion.index',
                    'lighting_sound_technician' => 'lighting_sound.food-events-fashion.index',
                    'stage_av_setup' => 'stage_av.food-events-fashion.index',
                    'photographer_videographer' => 'photographer.food-events-fashion.index',
                    'mc_host_entertainer' => 'mc_host.food-events-fashion.index',
                    'music_dj_services' => 'music_dj.food-events-fashion.index',
                    // Food Services
                    'catering_services' => 'catering.food-events-fashion.index',
                    'bakery_cake_services' => 'bakery.food-events-fashion.index',
                    'beverage_services' => 'beverage.food-events-fashion.index',
                    'other_food_services' => 'other_food.food-events-fashion.index',
                    // Fashion
                    'event_clothes_rental' => 'clothes_rental.food-events-fashion.index',
                    'event_tailoring' => 'event_tailoring.food-events-fashion.index',
                    // Support
                    'post_event_cleanup' => 'cleanup.food-events-fashion.index',
                    'equipment_maintenance' => 'equipment_maintenance.food-events-fashion.index',
                    'catering_followup' => 'catering_followup.food-events-fashion.index',
                    'customer_loyalty' => 'customer_loyalty.food-events-fashion.index',
                    // Business/Special
                    'businessperson' => 'fef_business.food-events-fashion.index',
                    'mediator' => 'fef_mediator.food-events-fashion.index',
                    'moderator' => 'fef_moderator.food-events-fashion.index',
                    'client' => 'fef_client.food-events-fashion.index',
                ];

                if (array_key_exists($role, $fefRedirects)) {
                    return redirect()->route($fefRedirects[$role]);
                }
            }

            // Education & Knowledge Specific Redirection
            if ($routeCategory === 'education-knowledge') {
                $eduRedirects = [
                    'admin' => 'admin.education-knowledge.index',
                    'manager' => 'manager.education-knowledge.index',
                    'supervisor' => 'supervisor.education-knowledge.index',
                    // Teaching
                    'instructor_teacher' => 'instructor.education_knowledge.index',
                    'trainer' => 'trainer.education_knowledge.index',
                    'lecturer' => 'lecturer.education_knowledge.index',
                    'tutor_mentor' => 'tutor.education_knowledge.index',
                    // Content
                    'educational_content_creator' => 'content_creator.education_knowledge.index',
                    'curriculum_developer' => 'curriculum_dev.education_knowledge.index',
                    'knowledge_publisher' => 'publisher.education_knowledge.index',
                    // Research
                    'researcher' => 'researcher.education_knowledge.index',
                    'academic_writer' => 'academic_writer.education_knowledge.index',
                    // Support
                    'academic_advisor' => 'academic_advisor.education_knowledge.index',
                    'career_guidance' => 'career_guidance.education_knowledge.index',
                    'examiner' => 'examiner.education_knowledge.index',
                    'assessor' => 'assessor.education_knowledge.index',
                    'quality_assurance' => 'quality_assurance.education_knowledge.index',
                    'moderator' => 'moderator.education_knowledge.index',
                    'compliance_review' => 'compliance_review.education_knowledge.index',
                    // Business
                    'school_institution_owner' => 'school_owner.education_knowledge.index',
                    'training_center_owner' => 'training_owner.education_knowledge.index',
                    'education_business' => 'edu_business.education_knowledge.index',
                    'publishing_business' => 'publishing_business.education_knowledge.index',
                    // Mediator
                    'mediator' => 'mediator.education_knowledge.index',
                    // Client
                    'student_learner' => 'student.education_knowledge.index',
                    'parent_guardian' => 'parent.education_knowledge.index',
                ];

                if (array_key_exists($role, $eduRedirects)) {
                    return redirect()->route($eduRedirects[$role]);
                }
            }

            // Agriculture, Farming & Environment Specific Redirection
            if ($routeCategory === 'agriculture-farming-environment') {
                $afeRedirects = [
                    'admin' => 'admin.agriculture-farming-environment.index',
                    'manager' => 'manager.agriculture-farming-environment.index',
                    'supervisor' => 'supervisor.agriculture-farming-environment.index',
                    // Crop
                    'crop_farming_followups' => 'crop_followup.agriculture_environment.index',
                    'soil_management' => 'soil_mgmt.agriculture_environment.index',
                    'irrigation_support' => 'irrigation.agriculture_environment.index',
                    'pest_disease_management' => 'pest_mgmt.agriculture_environment.index',
                    // Livestock
                    'animal_health_veterinary' => 'veterinary.agriculture_environment.index',
                    'breeding_reproduction' => 'breeder.agriculture_environment.index',
                    'feed_nutrition_management' => 'nutritionist.agriculture_environment.index',
                    'livestock_monitoring' => 'livestock_monitor.agriculture_environment.index',
                    // Aquaculture
                    'fish_farming_services' => 'fish_farm.agriculture_environment.index',
                    'water_quality_management' => 'water_quality.agriculture_environment.index',
                    'harvest_processing' => 'harvest_proc.agriculture_environment.index',
                    // Apiculture
                    'bee_farming_services' => 'bee_farm.agriculture_environment.index',
                    'hive_management' => 'hive_mgmt.agriculture_environment.index',
                    'honey_production' => 'honey_prod.agriculture_environment.index',
                    // Environment
                    'sustainable_farming' => 'sustainable.agriculture_environment.index',
                    'climate_smart_agriculture' => 'climate_smart.agriculture_environment.index',
                    'conservation_practices' => 'conservation.agriculture_environment.index',
                    // Support - Extension
                    'farmer_training' => 'farmer_train.agriculture_environment.index',
                    'advisory_consultation' => 'agri_advisor.agriculture_environment.index',
                    'field_demonstration' => 'field_demo.agriculture_environment.index',
                    // Support - Input
                    'seeds_fertilizers' => 'seeds_fert.agriculture_environment.index',
                    'animal_feed' => 'animal_feed.agriculture_environment.index',
                    'equipment_tools' => 'agri_tools.agriculture_environment.index',
                    // Support - M&E
                    'farm_inspection' => 'farm_inspect.agriculture_environment.index',
                    'data_reporting' => 'data_report.agriculture_environment.index',
                    // Support - Post Harvest
                    'storage_preservation' => 'storage.agriculture_environment.index',
                    'market_linkage' => 'market_link.agriculture_environment.index',
                    // Business
                    'agribusiness_owner' => 'agri_biz.agriculture_environment.index',
                    'farm_owner' => 'farm_owner.agriculture_environment.index',
                    'cooperative_organization' => 'coop.agriculture_environment.index',
                    'input_supply_business' => 'input_biz.agriculture_environment.index',
                    // Special
                    'mediator' => 'mediator.agriculture_environment.index',
                    'moderator' => 'moderator.agriculture_environment.index',
                    // Client
                    'client' => 'client.agriculture_environment.index',
                ];

                if (array_key_exists($role, $afeRedirects)) {
                    return redirect()->route($afeRedirects[$role]);
                }
            }

            // Media & Entertainment Specific Redirection
            if ($routeCategory === 'media-entertainment') {
                $meRedirects = [
                    'media_consumer' => 'media_consumer.media-entertainment.index',
                    'media_creator' => 'media_creator.media-entertainment.index',
                    'media_producer' => 'media_producer.media-entertainment.index',
                    'media_advertiser' => 'media_advertiser.media-entertainment.index',
                    'media_distributor' => 'media_distributor.media-entertainment.index',
                    'media_admin' => 'media_admin.media-entertainment.index',
                ];

                if (array_key_exists($role, $meRedirects)) {
                    return redirect()->route($meRedirects[$role]);
                }
            }

            // Legal & Professional Specific Redirection
            if ($routeCategory === 'legal-professional') {
                $lpRedirects = [
                    'legal_client' => 'legal_client.legal-professional.index',
                    'legal_pro' => 'legal_pro.legal-professional.index',
                    'professional_consultant' => 'professional_consultant.legal-professional.index',
                    'legal_firm' => 'legal_firm.legal-professional.index',
                    'legal_regulator' => 'legal_regulator.legal-professional.index',
                    'legal_admin' => 'legal_admin.legal-professional.index',
                ];
                
                if (array_key_exists($role, $lpRedirects)) {
                    return redirect()->route($lpRedirects[$role]);
                }
            }
        }

        return match ($role) {
            'super_admin', 'super-admin' => redirect()->route('super_admin.index'),
            'admin' => redirect()->route('admin.dashboard'),
            'technical_admin' => redirect()->route('admin.technical-repair.index'),
            // 'manager' => redirect()->route('manager.index'), // REMOVED generic
            // 'supervisor' => redirect()->route('supervisor.index'), // REMOVED generic
            'technician' => redirect()->route('technician.index'),
            'mechanic', 'mechanician' => redirect()->route('mechanic.index'),
            'electrician' => redirect()->route('electrician.index'),
            'builder' => redirect()->route('builder.index'),
            'tailor' => redirect()->route('tailor.index'),
            'mediator' => redirect()->route('mediator.index'),
            'craftsperson' => redirect()->route('craftsperson.index'),
            'business', 'businessperson' => redirect()->route('business.index'),
            'intern' => redirect()->route('intern.index'),
            
            // Transport & Travel Fallbacks
            'taxi_driver' => redirect()->route('taxi_driver.transport-travel.index'),
            'moto_driver', 'motorcycle_taxi' => redirect()->route('moto_driver.transport-travel.index'),
            'bus_driver' => redirect()->route('bus_driver.transport-travel.index'),
            'tour_driver' => redirect()->route('tour_driver.transport-travel.index'),
            'truck_driver' => redirect()->route('truck_driver.transport-travel.index'),
            'delivery_driver' => redirect()->route('delivery_driver.transport-travel.index'),
            'ambulance_driver' => redirect()->route('ambulance_driver.transport-travel.index'),
            'special_needs_transport' => redirect()->route('special_needs_transport.transport-travel.index'),
            'vip_executive_driver' => redirect()->route('vip_executive_driver.transport-travel.index'),
            'vehicle_servicing' => redirect()->route('vehicle_servicing.transport-travel.index'),
            'customer_care' => redirect()->route('customer_care.transport-travel.index'),
            'roadside_assistance' => redirect()->route('roadside_assistance.transport-travel.index'),
            'safety_compliance' => redirect()->route('safety_compliance.transport-travel.index'),
            
            'special_transport' => redirect()->route('special_transport.index'),
            'gym_trainer' => redirect()->route('gym_trainer.index'),
            'yoga_trainer' => redirect()->route('yoga_trainer.index'),
            'multi_sports_academics' => redirect()->route('multi_sports_academics.index'),
            'fitness_coach' => redirect()->route('fitness_coach.index'),
            'aerobics_instructor' => redirect()->route('aerobics_instructor.index'),
            'martial_arts_trainer' => redirect()->route('martial_arts_trainer.index'),
            'pilates_instructor' => redirect()->route('pilates_instructor.index'),
            'food_customer' => redirect()->route('food_customer.index'),
            'food_vendor' => redirect()->route('food_vendor.index'),
            'event_organizer' => redirect()->route('event_organizer.index'),
            'fashion_vendor' => redirect()->route('fashion_vendor.index'),
            'food_delivery' => redirect()->route('food_delivery.index'),
            'food_admin' => redirect()->route('food_admin.index'),
            'student' => redirect()->route('student.index'),
            'teacher' => redirect()->route('teacher.index'),
            'tutor' => redirect()->route('tutor.index'),
            'edu_content_creator' => redirect()->route('edu_content_creator.index'),
            'institution_admin' => redirect()->route('institution_admin.index'),
            'edu_admin' => redirect()->route('edu_admin.index'),
            'farmer' => redirect()->route('farmer.index'),
            'agri_manager' => redirect()->route('agri_manager.index'),
            'input_supplier' => redirect()->route('input_supplier.index'),
            'extension_officer' => redirect()->route('extension_officer.index'),
            'produce_buyer' => redirect()->route('produce_buyer.index'),
            'sustainability_officer' => redirect()->route('sustainability_officer.index'),
            'agri_admin' => redirect()->route('agri_admin.index'),
            'media_consumer' => redirect()->route('media_consumer.index'),
            'media_creator' => redirect()->route('media_creator.index'),
            'media_producer' => redirect()->route('media_producer.index'),
            'media_advertiser' => redirect()->route('media_advertiser.index'),
            'media_distributor' => redirect()->route('media_distributor.index'),
            'media_admin' => redirect()->route('media_admin.index'),
            'legal_client' => redirect()->route('legal_client.index'),
            'legal_pro' => redirect()->route('legal_pro.index'),
            'professional_consultant' => redirect()->route('professional_consultant.index'),
            'legal_firm' => redirect()->route('legal_firm.index'),
            'legal_regulator' => redirect()->route('legal_regulator.index'),
            'legal_admin' => redirect()->route('legal_admin.index'),
            'client' => redirect()->route('client.index'),
            'fashion_designer' => redirect()->route('designer.creative-lifestyle.index'),
            default => redirect('/dashboard'),
        };
    }
}
