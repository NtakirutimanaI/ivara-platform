import mongoose from 'mongoose';
import bcrypt from 'bcryptjs';
import dotenv from 'dotenv';

dotenv.config();

// User Schema
const UserSchema = new mongoose.Schema({
    name: { type: String, required: true },
    username: { type: String, required: true, unique: true },
    email: { type: String, required: true, unique: true },
    password: { type: String, required: true },
    role: { type: String, required: true },
    category: { type: String },
    status: { type: String, default: 'offline' }, // Added status field to match main model
    isActive: { type: Boolean, default: true },
}, { timestamps: true });

const User = mongoose.model('User', UserSchema);

const seedUsers = async () => {
    try {
        const mongoUri = process.env.MONGODB_URI || 'mongodb://127.0.0.1:27017/ivara';
        await mongoose.connect(mongoUri);

        console.log('✅ Connected to MongoDB');

        // Drop indexes and clear users
        try { await User.collection.dropIndexes(); } catch (e) { }
        await User.deleteMany({});
        console.log('🗑️  Cleared existing users');

        const hashedPassword = await bcrypt.hash('password', 10);

        // Define Categories
        const categories = [
            { id: 'technical-repair', name: 'Technical & Repair' },
            { id: 'creative-lifestyle', name: 'Creative & Lifestyle' },
            { id: 'transport-travel', name: 'Transport & Travel' },
            { id: 'food-events-fashion', name: 'Food, Events & Fashion' },
            { id: 'education-knowledge', name: 'Education & Knowledge' },
            { id: 'agriculture-environment', name: 'Agriculture & Environment' },
            { id: 'media-entertainment', name: 'Media & Entertainment' },
            { id: 'legal-professional', name: 'Legal & Professional' },
            { id: 'other-services', name: 'Other Services' }
        ];

        const users: any[] = [
            // SYSTEM ADMIN
            {
                name: 'Super Admin',
                email: 'ivara.superadmin@gmail.com',
                password: hashedPassword,
                role: 'super_admin',
                isActive: true,
            }
        ];

        // Generate 3 Admins per category (Total 27)
        categories.forEach(cat => {
            let slug = cat.id.split('-')[0]; // simple slug like 'tech', 'creative'
            if (slug === 'technical') slug = 'tech'; // Use 'tech' instead of 'technical' to match documentation
            if (slug === 'agriculture') slug = 'agri';
            if (slug === 'transport') slug = 'tth';
            if (slug === 'food') slug = 'fef';
            if (slug === 'education') slug = 'edu';

            // 1. Admin
            users.push({
                name: `${cat.name} Admin`,
                email: `${slug}.admin@ivara.com`,
                password: hashedPassword,
                role: 'admin',
                category: cat.id,
                isActive: true
            });

            // 2. Manager
            users.push({
                name: `${cat.name} Manager`,
                email: `${slug}.manager@ivara.com`,
                password: hashedPassword,
                role: 'manager',
                category: cat.id,
                isActive: true
            });

            // 3. Supervisor
            users.push({
                name: `${cat.name} Supervisor`,
                email: `${slug}.supervisor@ivara.com`,
                password: hashedPassword,
                role: 'supervisor',
                category: cat.id,
                isActive: true
            });
        });

        // --- SPECIFIC TECHNICAL & REPAIR ROLES ---
        const techRoles = [
            { name: 'Business Person', role: 'business', email: 'business.tech@ivara.com' },
            { name: 'Craftsperson', role: 'craftsperson', email: 'crafts.tech@ivara.com' },
            { name: 'Builder', role: 'builder', email: 'builder.tech@ivara.com' },
            { name: 'Electrician', role: 'electrician', email: 'electrician.tech@ivara.com' },
            { name: 'Tailor', role: 'tailor', email: 'tailor.tech@ivara.com' },
            { name: 'Mediator', role: 'mediator', email: 'mediator.tech@ivara.com' },
            { name: 'Mechanician', role: 'mechanic', email: 'mechanic.tech@ivara.com' },
            { name: 'Technician', role: 'technician', email: 'technician.tech@ivara.com' },
            { name: 'Client', role: 'client', email: 'client.tech@ivara.com' }
        ];

        techRoles.forEach(r => {
            users.push({
                name: r.name,
                email: r.email,
                password: hashedPassword,
                role: r.role,
                category: 'technical-repair',
                isActive: true
            });
        });

        // --- SPECIFIC CREATIVE & LIFESTYLE ROLES ---
        const clwRoles = [
            // Management (Override default generated ones if needed, or rely on loop)
            { name: 'CLW Admin', role: 'admin', email: 'clw.admin@ivara.com' },
            { name: 'CLW Manager', role: 'manager', email: 'clw.manager@ivara.com' },
            { name: 'CLW Supervisor', role: 'supervisor', email: 'clw.supervisor@ivara.com' },

            // Creative Service Providers
            { name: 'Fashion Designer', role: 'fashion_designer', email: 'fashion.designer@ivara.com' },
            { name: 'Influencer', role: 'influencer', email: 'influencer@ivara.com' },
            { name: 'Musician', role: 'musician', email: 'musician@ivara.com' },
            { name: 'Photographer', role: 'photographer', email: 'photographer@ivara.com' },
            { name: 'Artist', role: 'artist', email: 'artist@ivara.com' },

            // Wellness Service Providers
            { name: 'Massage Therapist', role: 'massage_therapist', email: 'massage.therapist@ivara.com' },
            { name: 'Spa Specialist', role: 'spa_specialist', email: 'spa.specialist@ivara.com' },
            { name: 'Fitness Trainer', role: 'fitness_trainer', email: 'fitness.trainer@ivara.com' },
            { name: 'Yoga Instructor', role: 'yoga_instructor', email: 'yoga.instructor@ivara.com' },
            { name: 'Wellness Coach', role: 'wellness_coach', email: 'wellness.coach@ivara.com' },
            { name: 'Life Coach', role: 'life_coach', email: 'life.coach@ivara.com' },
            { name: 'Nutritionist', role: 'nutritionist', email: 'nutritionist@ivara.com' },
            { name: 'Therapist', role: 'therapist', email: 'therapist@ivara.com' },

            // Businessperson (Organizations)
            { name: 'Studio/Gym Owner', role: 'business', email: 'studio.owner@ivara.com' },
            { name: 'Brand Agency', role: 'business', email: 'brand.agency@ivara.com' },
            { name: 'Event Organizer', role: 'business', email: 'event.organizer@ivara.com' },
            { name: 'Talent Manager', role: 'business', email: 'talent.manager@ivara.com' },

            // Special Roles
            { name: 'Mediator', role: 'mediator', email: 'mediator.clw@ivara.com' },
            { name: 'Moderator', role: 'moderator', email: 'moderator.clw@ivara.com' },

            // End Users
            { name: 'Client', role: 'client', email: 'client.clw@ivara.com' }
        ];

        clwRoles.forEach(r => {
            users.push({
                name: r.name,
                email: r.email,
                password: hashedPassword,
                role: r.role,
                category: 'creative-lifestyle', // Fixed to match slug creative-lifestyle
                isActive: true
            });
        });

        // --- SPECIFIC TRANSPORT & TRAVEL ROLES ---
        const tthRoles = [
            // Management
            { name: 'Transport Admin', role: 'admin', email: 'tth.admin@ivara.com' },
            { name: 'Transport Manager', role: 'manager', email: 'tth.manager@ivara.com' },
            { name: 'Transport Supervisor', role: 'supervisor', email: 'tth.supervisor@ivara.com' },

            // Service Providers - Transport Services
            { name: 'Taxi Driver', role: 'taxi_driver', email: 'taxi.driver@ivara.com' },
            { name: 'Moto Driver', role: 'moto_driver', email: 'moto.driver@ivara.com' },
            { name: 'Bus Driver', role: 'bus_driver', email: 'bus.driver@ivara.com' },
            { name: 'Truck Driver', role: 'truck_driver', email: 'truck.driver@ivara.com' },
            { name: 'Tour Driver', role: 'tour_driver', email: 'tour.driver@ivara.com' },
            { name: 'Delivery Driver', role: 'delivery_driver', email: 'delivery.driver@ivara.com' },

            // Service Providers - Special Transport
            { name: 'Ambulance Driver', role: 'ambulance_driver', email: 'ambulance.driver@ivara.com' },
            { name: 'Special Needs Driver', role: 'special_needs_transport', email: 'special.transport@ivara.com' },
            { name: 'VIP Executive Driver', role: 'vip_executive_driver', email: 'vip.driver@ivara.com' },

            // Support Provider
            { name: 'Vehicle Servicing', role: 'vehicle_servicing', email: 'vehicle.servicing@ivara.com' },
            { name: 'Customer Care', role: 'customer_care', email: 'customer.care@ivara.com' },
            { name: 'Roadside Assistance', role: 'roadside_assistance', email: 'roadside.assist@ivara.com' },
            { name: 'Safety Compliance', role: 'safety_compliance', email: 'safety.officer@ivara.com' },

            // Businessperson
            { name: 'Transport Business', role: 'businessperson', email: 'tth.business@ivara.com' },

            // Special Roles
            { name: 'TTH Mediator', role: 'mediator', email: 'tth.mediator@ivara.com' },
            { name: 'TTH Moderator', role: 'moderator', email: 'tth.moderator@ivara.com' },

            // End Users
            { name: 'Transport Client', role: 'client', email: 'client.tth@ivara.com' },
        ];

        tthRoles.forEach(r => {
            users.push({
                name: r.name,
                email: r.email,
                password: hashedPassword,
                role: r.role,
                category: 'transport-travel',
                isActive: true
            });
        });

        // --- SPECIFIC FOOD, EVENTS & FASHION ROLES ---
        const fefRoles = [
            // Management
            { name: 'FEF Admin', role: 'admin', email: 'fef.admin@ivara.com' },
            { name: 'FEF Manager', role: 'manager', email: 'fef.manager@ivara.com' },
            { name: 'FEF Supervisor', role: 'supervisor', email: 'fef.supervisor@ivara.com' },

            // Service Providers - Event Planning
            { name: 'Event Coordinator', role: 'event_coordinator', email: 'event.coordinator@ivara.com' },
            { name: 'Wedding Planner', role: 'wedding_planner', email: 'wedding.planner@ivara.com' },
            { name: 'Corporate Organizer', role: 'corporate_event_organizer', email: 'corporate.organizer@ivara.com' },
            { name: 'Birthday Organizer', role: 'birthday_party_organizer', email: 'birthday.organizer@ivara.com' },
            { name: 'Conference Organizer', role: 'conference_seminar_organizer', email: 'conference.organizer@ivara.com' },
            { name: 'Exhibition Organizer', role: 'exhibition_trade_fair_organizer', email: 'exhibition.organizer@ivara.com' },

            // Service Providers - Party Services
            { name: 'Decorator', role: 'decorator_event_stylist', email: 'decorator@ivara.com' },
            { name: 'Lighting & Sound', role: 'lighting_sound_technician', email: 'lighting.sound@ivara.com' },
            { name: 'Stage Setup', role: 'stage_av_setup', email: 'stage.setup@ivara.com' },
            { name: 'Photographer', role: 'photographer_videographer', email: 'photographer@ivara.com' },
            { name: 'Entertainer', role: 'mc_host_entertainer', email: 'entertainer@ivara.com' },
            { name: 'DJ Services', role: 'music_dj_services', email: 'music.dj@ivara.com' },

            // Service Providers - Food Services
            { name: 'Catering Service', role: 'catering_services', email: 'catering@ivara.com' },
            { name: 'Bakery Service', role: 'bakery_cake_services', email: 'bakery@ivara.com' },
            { name: 'Beverage Service', role: 'beverage_services', email: 'beverage@ivara.com' },
            { name: 'Other Food Service', role: 'other_food_services', email: 'other.food@ivara.com' },

            // Service Providers - Fashion
            { name: 'Clothes Rental', role: 'event_clothes_rental', email: 'clothes.rental@ivara.com' },
            { name: 'Event Tailor', role: 'event_tailoring', email: 'tailor@ivara.com' },

            // Support Provider
            { name: 'Cleanup Crew', role: 'post_event_cleanup', email: 'cleanup.crew@ivara.com' },
            { name: 'Equipment Maintenance', role: 'equipment_maintenance', email: 'equip.maintenance@ivara.com' },
            { name: 'Catering Feedback', role: 'catering_followup', email: 'catering.feedback@ivara.com' },
            { name: 'Customer Loyalty', role: 'customer_loyalty', email: 'customer.loyalty@ivara.com' },

            // Business & Special
            { name: 'FEF Business', role: 'businessperson', email: 'fef.business@ivara.com' },
            { name: 'FEF Mediator', role: 'mediator', email: 'fef.mediator@ivara.com' },
            { name: 'FEF Moderator', role: 'moderator', email: 'fef.moderator@ivara.com' },
            { name: 'FEF Client', role: 'client', email: 'fef.client@ivara.com' },
        ];

        fefRoles.forEach(r => {
            users.push({
                name: r.name,
                email: r.email,
                password: hashedPassword,
                role: r.role,
                category: 'food-events-fashion',
                isActive: true
            });
        });

        // --- SPECIFIC EDUCATION & KNOWLEDGE ROLES ---
        const ekRoles = [
            // Management
            { name: 'Edu Admin', role: 'admin', email: 'edu.admin@ivara.com' },
            { name: 'Edu Manager', role: 'manager', email: 'edu.manager@ivara.com' },
            { name: 'Edu Supervisor', role: 'supervisor', email: 'edu.supervisor@ivara.com' },

            // Teaching & Training
            { name: 'Instructor/Teacher', role: 'instructor_teacher', email: 'instructor@ivara.com' },
            { name: 'Trainer', role: 'trainer', email: 'trainer@ivara.com' },
            { name: 'Lecturer', role: 'lecturer', email: 'lecturer@ivara.com' },
            { name: 'Tutor/Mentor', role: 'tutor_mentor', email: 'tutor@ivara.com' },

            // Content & Knowledge
            { name: 'Edu Content Creator', role: 'educational_content_creator', email: 'edu.creator@ivara.com' },
            { name: 'Curriculum Developer', role: 'curriculum_developer', email: 'curriculum.dev@ivara.com' },
            { name: 'Knowledge Publisher', role: 'knowledge_publisher', email: 'publisher@ivara.com' },

            // Research & Academic
            { name: 'Researcher', role: 'researcher', email: 'researcher@ivara.com' },
            { name: 'Academic Writer', role: 'academic_writer', email: 'academic.writer@ivara.com' },

            // Support - Advisory
            { name: 'Academic Advisor', role: 'academic_advisor', email: 'academic.advisor@ivara.com' },
            { name: 'Career Guidance', role: 'career_guidance', email: 'career.guide@ivara.com' },

            // Support - Assessment
            { name: 'Examiner', role: 'examiner', email: 'examiner@ivara.com' },
            { name: 'Assessor', role: 'assessor', email: 'assessor@ivara.com' },
            { name: 'Quality Assurance', role: 'quality_assurance', email: 'qa.officer@ivara.com' },

            // Support - Moderation & Compliance
            { name: 'Edu Moderator', role: 'moderator', email: 'edu.moderator@ivara.com' },
            { name: 'Compliance Review', role: 'compliance_review', email: 'compliance@ivara.com' },

            // Businessperson
            { name: 'School Owner', role: 'school_institution_owner', email: 'school.owner@ivara.com' },
            { name: 'Training Center Owner', role: 'training_center_owner', email: 'training.owner@ivara.com' },
            { name: 'Edu Business', role: 'education_business', email: 'edu.business@ivara.com' },
            { name: 'Publishing Business', role: 'publishing_business', email: 'publishing.biz@ivara.com' },

            // Special
            { name: 'Edu Mediator', role: 'mediator', email: 'edu.mediator@ivara.com' },

            // Clients
            { name: 'Student', role: 'student_learner', email: 'student@ivara.com' },
            { name: 'Parent', role: 'parent_guardian', email: 'parent@ivara.com' },
        ];

        ekRoles.forEach(r => {
            users.push({
                name: r.name,
                email: r.email,
                password: hashedPassword,
                role: r.role,
                category: 'education-knowledge',
                isActive: true
            });
        });

        // --- SPECIFIC AGRICULTURE & ENVIRONMENT ROLES ---
        const afeRoles = [
            // Management
            { name: 'Agri Admin', role: 'admin', email: 'agri.admin@ivara.com' },
            { name: 'Agri Manager', role: 'manager', email: 'agri.manager@ivara.com' },
            { name: 'Agri Supervisor', role: 'supervisor', email: 'agri.supervisor@ivara.com' },

            // Service - Crop Farming
            { name: 'Crop Followup', role: 'crop_farming_followups', email: 'crop.followup@ivara.com' },
            { name: 'Soil Management', role: 'soil_management', email: 'soil.mgmt@ivara.com' },
            { name: 'Irrigation Support', role: 'irrigation_support', email: 'irrigation@ivara.com' },
            { name: 'Pest Management', role: 'pest_disease_management', email: 'pest.mgmt@ivara.com' },

            // Service - Livestock
            { name: 'Veterinary', role: 'animal_health_veterinary', email: 'vet@ivara.com' },
            { name: 'Breeding', role: 'breeding_reproduction', email: 'breeder@ivara.com' },
            { name: 'Nutritionist', role: 'feed_nutrition_management', email: 'nutritionist@ivara.com' },
            { name: 'Livestock Monitor', role: 'livestock_monitoring', email: 'livestock.monitor@ivara.com' },

            // Service - Aquaculture
            { name: 'Fish Farmer', role: 'fish_farming_services', email: 'fish.farmer@ivara.com' },
            { name: 'Water Quality', role: 'water_quality_management', email: 'water.quality@ivara.com' },
            { name: 'Harvest Processor', role: 'harvest_processing', email: 'harvest.proc@ivara.com' },

            // Service - Apiculture
            { name: 'Bee Farmer', role: 'bee_farming_services', email: 'bee.farmer@ivara.com' },
            { name: 'Hive Manager', role: 'hive_management', email: 'hive.mgmt@ivara.com' },
            { name: 'Honey Producer', role: 'honey_production', email: 'honey.prod@ivara.com' },

            // Service - Environmental
            { name: 'Sustainable Farmer', role: 'sustainable_farming', email: 'sustainable.farm@ivara.com' },
            { name: 'Climate Smart', role: 'climate_smart_agriculture', email: 'climate.smart@ivara.com' },
            { name: 'Conservationist', role: 'conservation_practices', email: 'conservation@ivara.com' },

            // Support - Extension
            { name: 'Farmer Trainer', role: 'farmer_training', email: 'farmer.trainer@ivara.com' },
            { name: 'Agri Advisor', role: 'advisory_consultation', email: 'agri.advisor@ivara.com' },
            { name: 'Field Demo', role: 'field_demonstration', email: 'field.demo@ivara.com' },

            // Support - Input
            { name: 'Seeds & Fertilizer', role: 'seeds_fertilizers', email: 'seeds.fert@ivara.com' },
            { name: 'Animal Feed', role: 'animal_feed', email: 'animal.feed@ivara.com' },
            { name: 'Agri Tools', role: 'equipment_tools', email: 'agri.tools@ivara.com' },

            // Support - M&E
            { name: 'Farm Inspector', role: 'farm_inspection', email: 'farm.inspector@ivara.com' },
            { name: 'Data Reporter', role: 'data_reporting', email: 'data.reporter@ivara.com' },

            // Support - Post Harvest
            { name: 'Storage Support', role: 'storage_preservation', email: 'storage@ivara.com' },
            { name: 'Market Linkage', role: 'market_linkage', email: 'market.link@ivara.com' },

            // Business
            { name: 'Agribusiness Owner', role: 'agribusiness_owner', email: 'agri.biz.owner@ivara.com' },
            { name: 'Farm Owner', role: 'farm_owner', email: 'farm.owner@ivara.com' },
            { name: 'Cooperative', role: 'cooperative_organization', email: 'coop@ivara.com' },
            { name: 'Input Biz', role: 'input_supply_business', email: 'input.biz@ivara.com' },

            // Special
            { name: 'Agri Mediator', role: 'mediator', email: 'agri.mediator@ivara.com' },
            { name: 'Agri Moderator', role: 'moderator', email: 'agri.moderator@ivara.com' },

            // Client
            { name: 'Agri Client', role: 'client', email: 'agri.client@ivara.com' },
        ];

        afeRoles.forEach(r => {
            users.push({
                name: r.name,
                email: r.email,
                password: hashedPassword,
                role: r.role,
                category: 'agriculture-farming-environment',
                isActive: true
            });
        });

        // --- SPECIFIC MEDIA & ENTERTAINMENT ROLES ---
        const mediaRoles = [
            { name: 'Media Admin', role: 'media_admin', email: 'mediaadmin@ivara.com' },
            { name: 'Media Creator', role: 'media_creator', email: 'creator@media.com' },
            { name: 'Media Producer', role: 'media_producer', email: 'producer@media.com' },
            { name: 'Media Advertiser', role: 'media_advertiser', email: 'advertiser@media.com' },
            { name: 'Media Distributor', role: 'media_distributor', email: 'distributor@media.com' },
            { name: 'Media Consumer', role: 'media_consumer', email: 'consumer@media.com' },
        ];

        mediaRoles.forEach(r => {
            users.push({
                name: r.name,
                email: r.email,
                password: hashedPassword,
                role: r.role,
                category: 'media-entertainment',
                isActive: true
            });
        });

        // --- SPECIFIC LEGAL & PROFESSIONAL ROLES ---
        const legalRoles = [
            { name: 'Legal Admin', role: 'legal_admin', email: 'legaladmin@ivara.com' },
            { name: 'Legal Professional', role: 'legal_pro', email: 'pro@legal.com' },
            { name: 'Consultant', role: 'professional_consultant', email: 'consultant@legal.com' },
            { name: 'Legal Firm', role: 'legal_firm', email: 'firm@legal.com' },
            { name: 'Regulator', role: 'legal_regulator', email: 'regulator@legal.com' },
            { name: 'Legal Client', role: 'legal_client', email: 'client@legal.com' },
        ];

        legalRoles.forEach(r => {
            users.push({
                name: r.name,
                email: r.email,
                password: hashedPassword,
                role: r.role,
                category: 'legal-professional',
                isActive: true
            });
        });

        // --- SPECIFIC OTHER SERVICES ROLES ---
        const otherRoles = [
            { name: 'Other Admin', role: 'admin', email: 'other.admin@ivara.com', status: 'online' },
            { name: 'Other Manager', role: 'manager', email: 'other.manager@ivara.com', status: 'online' },
            // Explicit Subscribed Users for Testing
            { name: 'Subscribed Provider', role: 'provider', email: 'provider.active@ivara.com', status: 'active' },
            { name: 'Subscribed Business', role: 'businessperson', email: 'business.active@ivara.com', status: 'active' }
        ];

        otherRoles.forEach(r => {
            users.push({
                name: r.name,
                email: r.email,
                password: hashedPassword,
                role: r.role,
                category: 'other-services',
                status: r.status || 'active', // Default to active for these so they show up
                isActive: true
            });
        });

        categories.forEach(cat => {
            const slug = cat.id.split('-')[0];
            users.push({
                name: `${cat.name} Provider`,
                email: `provider.${slug}@ivara.com`,
                password: hashedPassword,
                role: 'technician',
                category: cat.id,
                status: 'active', // Ensure these show up as active subscriptions
                isActive: true
            });
            users.push({
                name: `${cat.name} Client`,
                email: `client.${slug}@ivara.com`,
                password: hashedPassword,
                role: 'user',
                category: cat.id,
                status: 'online',
                isActive: true
            });
        });

        // Add usernames and insert
        const usersToInsert = users.map(u => ({
            ...u,
            username: u.email.split('@')[0]
        }));

        await User.insertMany(usersToInsert);

        console.log(`✅ Successfully seeded ${usersToInsert.length} users.`);
        process.exit(0);
    } catch (error) {
        console.error('❌ Seeding failed:', error);
        process.exit(1);
    }
};

seedUsers();
