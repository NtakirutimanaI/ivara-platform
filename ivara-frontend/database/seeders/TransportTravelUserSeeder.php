<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\File;

class TransportTravelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('password');

        $users = [
            // Management
            ['name' => 'Transport Admin', 'email' => 'tth.admin@ivara.com', 'role' => 'admin', 'category' => 'transport-travel'],
            ['name' => 'Transport Manager', 'email' => 'tth.manager@ivara.com', 'role' => 'manager', 'category' => 'transport-travel'],
            ['name' => 'Transport Supervisor', 'email' => 'tth.supervisor@ivara.com', 'role' => 'supervisor', 'category' => 'transport-travel'],

            // Service Providers - Transport Services
            ['name' => 'Taxi Driver', 'email' => 'taxi.driver@ivara.com', 'role' => 'taxi_driver', 'category' => 'transport-travel'],
            ['name' => 'Moto Driver', 'email' => 'moto.driver@ivara.com', 'role' => 'moto_driver', 'category' => 'transport-travel'],
            ['name' => 'Bus Driver', 'email' => 'bus.driver@ivara.com', 'role' => 'bus_driver', 'category' => 'transport-travel'],
            ['name' => 'Truck Driver', 'email' => 'truck.driver@ivara.com', 'role' => 'truck_driver', 'category' => 'transport-travel'],
            ['name' => 'Tour Driver', 'email' => 'tour.driver@ivara.com', 'role' => 'tour_driver', 'category' => 'transport-travel'],
            ['name' => 'Delivery Driver', 'email' => 'delivery.driver@ivara.com', 'role' => 'delivery_driver', 'category' => 'transport-travel'],

            // Service Providers - Special Transport
            ['name' => 'Ambulance Driver', 'email' => 'ambulance.driver@ivara.com', 'role' => 'ambulance_driver', 'category' => 'transport-travel'],
            ['name' => 'Special Needs Driver', 'email' => 'special.transport@ivara.com', 'role' => 'special_needs_transport', 'category' => 'transport-travel'],
            ['name' => 'VIP Executive Driver', 'email' => 'vip.driver@ivara.com', 'role' => 'vip_executive_driver', 'category' => 'transport-travel'],

            // Support Provider
            ['name' => 'Vehicle Servicing', 'email' => 'vehicle.servicing@ivara.com', 'role' => 'vehicle_servicing', 'category' => 'transport-travel'],
            ['name' => 'Customer Care', 'email' => 'customer.care@ivara.com', 'role' => 'customer_care', 'category' => 'transport-travel'],
            ['name' => 'Roadside Assistance', 'email' => 'roadside.assist@ivara.com', 'role' => 'roadside_assistance', 'category' => 'transport-travel'],
            ['name' => 'Safety Compliance', 'email' => 'safety.officer@ivara.com', 'role' => 'safety_compliance', 'category' => 'transport-travel'],

            // Businessperson
            ['name' => 'Transport Business', 'email' => 'tth.business@ivara.com', 'role' => 'businessperson', 'category' => 'transport-travel'],

            // Special Roles
            ['name' => 'TTH Mediator', 'email' => 'tth.mediator@ivara.com', 'role' => 'mediator', 'category' => 'transport-travel'],
            ['name' => 'TTH Moderator', 'email' => 'tth.moderator@ivara.com', 'role' => 'moderator', 'category' => 'transport-travel'],

            // End Users
            ['name' => 'Transport Client', 'email' => 'client.tth@ivara.com', 'role' => 'client', 'category' => 'transport-travel'],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => $password,
                    'role' => $userData['role'],
                    'category' => $userData['category'],
                    'username' => strtolower(str_replace(' ', '', $userData['name'])) . rand(100, 999),
                ]
            );
        }

        // Append to documentation
        $docPath = base_path('../documentation.txt');
        $docContent = "
---

### 4. Transport, Travel & Hospitality Category Credentials
*All accounts use password: \"password\"*
*Dashboard Theme: Light Blue*

#### Management
- Admin:        tth.admin@ivara.com
- Manager:      tth.manager@ivara.com
- Supervisor:   tth.supervisor@ivara.com

#### Service Providers - Transport Services
- Taxi Driver:      taxi.driver@ivara.com
- Moto Driver:      moto.driver@ivara.com
- Bus Driver:       bus.driver@ivara.com
- Truck Driver:     truck.driver@ivara.com
- Tour Driver:      tour.driver@ivara.com
- Delivery Driver:  delivery.driver@ivara.com

#### Service Providers - Special Transport
- Ambulance Driver:     ambulance.driver@ivara.com
- Special Needs:        special.transport@ivara.com
- VIP Driver:           vip.driver@ivara.com

#### Support Providers
- Vehicle Servicing:    vehicle.servicing@ivara.com
- Customer Care:        customer.care@ivara.com
- Roadside Assist:      roadside.assist@ivara.com
- Safety Officer:       safety.officer@ivara.com

#### Business & Special Roles
- Businessperson:   tth.business@ivara.com
- Mediator:         tth.mediator@ivara.com
- Moderator:        tth.moderator@ivara.com

#### End Users
- Client:           client.tth@ivara.com
";
        // Simple append, beware of duplicates if run multiple times, but acceptable for this context
        if (File::exists($docPath)) {
            File::append($docPath, $docContent);
        }
    }
}
