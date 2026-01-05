<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Seed the clients table with sample data.
     */
    public function run(): void
    {
        $clients = [
            [
                'name' => 'John Doe',
                'phone' => '+250 788 123 456',
                'email' => 'john.doe@email.com',
                'address' => 'KG 123 Street, Kacyiru',
                'city' => 'Kigali',
                'country' => 'Rwanda',
                'national_id' => '1199880012345678',
                'gender' => 'Male',
                'notes' => 'Regular customer, prefers SMS notifications',
            ],
            [
                'name' => 'Alice Uwimana',
                'phone' => '+250 722 456 789',
                'email' => 'alice.uwimana@gmail.com',
                'address' => 'KN 45 Avenue, Nyarugenge',
                'city' => 'Kigali',
                'country' => 'Rwanda',
                'national_id' => '1199590034567890',
                'gender' => 'Female',
                'notes' => 'Corporate client from TechSolutions Ltd',
            ],
            [
                'name' => 'Patrick Mugabo',
                'phone' => '+250 733 789 012',
                'email' => 'pmugabo@yahoo.com',
                'address' => 'KK 78 Road, Gisozi',
                'city' => 'Kigali',
                'country' => 'Rwanda',
                'national_id' => '1198580056789012',
                'gender' => 'Male',
                'notes' => 'Business owner, multiple devices for repair',
            ],
            [
                'name' => 'Marie Claire Ishimwe',
                'phone' => '+250 788 345 678',
                'email' => 'mclaire.ishimwe@email.com',
                'address' => 'KG 234 Street, Remera',
                'city' => 'Kigali',
                'country' => 'Rwanda',
                'national_id' => '1200180078901234',
                'gender' => 'Female',
                'notes' => 'Student, discount applicable',
            ],
            [
                'name' => 'Emmanuel Niyonzima',
                'phone' => '+250 728 901 234',
                'email' => 'e.niyonzima@company.rw',
                'address' => 'KN 12 Avenue, Kimihurura',
                'city' => 'Kigali',
                'country' => 'Rwanda',
                'national_id' => '1199280090123456',
                'gender' => 'Male',
                'notes' => 'VIP client - Priority service',
            ],
            [
                'name' => 'Sarah Mukamana',
                'phone' => '+250 785 567 890',
                'email' => 'sarah.mukamana@outlook.com',
                'address' => 'KG 567 Street, Kibagabaga',
                'city' => 'Kigali',
                'country' => 'Rwanda',
                'national_id' => '1199780012345678',
                'gender' => 'Female',
                'notes' => 'Referred by Emmanuel Niyonzima',
            ],
            [
                'name' => 'Tech Solutions Ltd',
                'phone' => '+250 788 000 111',
                'email' => 'info@techsolutions.rw',
                'address' => 'Kigali Heights, 10th Floor',
                'city' => 'Kigali',
                'country' => 'Rwanda',
                'national_id' => null,
                'gender' => null,
                'notes' => 'Corporate account - 50+ devices annually',
            ],
            [
                'name' => 'David Habimana',
                'phone' => '+250 722 111 222',
                'email' => 'david.habimana@gmail.com',
                'address' => 'KK 90 Road, Kicukiro',
                'city' => 'Kigali',
                'country' => 'Rwanda',
                'national_id' => '1199180023456789',
                'gender' => 'Male',
                'notes' => 'IT professional, knowledgeable about devices',
            ],
            [
                'name' => 'Grace Umutoniwase',
                'phone' => '+250 733 222 333',
                'email' => 'grace.u@email.com',
                'address' => 'KG 789 Street, Gikondo',
                'city' => 'Kigali',
                'country' => 'Rwanda',
                'national_id' => '1200080045678901',
                'gender' => 'Female',
                'notes' => 'First-time customer',
            ],
            [
                'name' => 'Jean Baptiste Ndayisaba',
                'phone' => '+250 788 333 444',
                'email' => 'jb.ndayisaba@business.rw',
                'address' => 'KN 234 Avenue, Downtown',
                'city' => 'Kigali',
                'country' => 'Rwanda',
                'national_id' => '1197580067890123',
                'gender' => 'Male',
                'notes' => 'Long-term client since 2019',
            ],
        ];

        foreach ($clients as $client) {
            Client::firstOrCreate(
                ['email' => $client['email']],
                $client
            );
        }

        $this->command->info('✅ Successfully seeded ' . count($clients) . ' clients');
    }
}
