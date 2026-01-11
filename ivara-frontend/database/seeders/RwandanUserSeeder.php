<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RwandanUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'technical-repair' => 'Technical & Repair',
            'creative-lifestyle' => 'Creative & Lifestyle',
            'transport-travel' => 'Transport & Travel',
            'food-fashion-events' => 'Food, Fashion & Events',
            'education-knowledge' => 'Education & Knowledge',
            'agriculture-environment' => 'Agriculture & Environment',
            'media-entertainment' => 'Media & Entertainment',
            'legal-professional' => 'Legal & Professional',
            'other-services' => 'Other Services'
        ];

        $roles = ['admin', 'manager', 'supervisor'];

        $rwandanNames = [
            'Jean Bosco Niyonsaba', 'Mutoni Alice', 'Karasira Eric', 
            'Uwimana Marie', 'Habimana Innocent', 'Umutoniwase Solange', 
            'Gakuba Benjamin', 'Murekatete Claudine', 'Ishimwe Didier',
            'Mukansanga Salome', 'Bizimana Jean de Dieu', 'Uwera Beatrice',
            'Ndayisaba Fabrice', 'Mukandutiye Seraphine', 'Rutayisire David',
            'Uwizeye Claudine', 'Kalisa John', 'Mutesi Divine',
            'Jean Damascene Ntabanganyimana', 'Nyirahabimana Speciose', 'Manzi Olivier',
            'Umubyeyi Diane', 'Nkurunziza Pascal', 'Mugenzi Aimable',
            'Uwimana Josiane', 'Tuyishime Innocent', 'Karasira Benjamin'
        ];

        $nameIndex = 0;
        $usersCreated = [];

        foreach ($categories as $slug => $displayName) {
            foreach ($roles as $roleName) {
                $name = $rwandanNames[$nameIndex % count($rwandanNames)];
                $firstName = explode(' ', $name)[0];
                $email = strtolower($firstName) . '.' . strtolower($roleName) . '.' . str_replace('-', '', $slug) . '@ivara.rw';
                
                // Ensure unique email by adding index if needed (though unlikely with this pattern)
                $tempEmail = $email;
                $counter = 1;
                while (User::where('email', $tempEmail)->exists()) {
                    $tempEmail = strtolower($firstName) . '.' . strtolower($roleName) . $counter . '.' . str_replace('-', '', $slug) . '@ivara.rw';
                    $counter++;
                }
                $email = $tempEmail;

                $phone = '78' . rand(1000000, 9999999);
                
                $user = User::create([
                    'name' => $name,
                    'username' => strtolower($firstName) . rand(100, 999),
                    'country_code' => '+250',
                    'phone' => $phone,
                    'email' => $email,
                    'password' => Hash::make('password'),
                    'role' => $roleName,
                    'category' => $displayName,
                    'status' => 'Active',
                ]);

                // Assign spatie role
                $user->assignRole($roleName);

                $usersCreated[] = [
                    'category' => $displayName,
                    'name' => $name,
                    'role' => $roleName,
                    'email' => $email,
                    'password' => 'password'
                ];

                $nameIndex++;
            }
        }

        // Output summary for the user to copy or for me to save
        $this->command->info('Created ' . count($usersCreated) . ' Rwandan users across all categories.');
        
        // Save to a temporary file or just keep in memory to write to documentation.txt later
        $logContent = "### Rwandan Support Staff Credentials\n\n";
        foreach (collect($usersCreated)->groupBy('category') as $category => $users) {
            $logContent .= "#### Category: $category\n";
            $logContent .= "| Name | Role | Email | Password |\n";
            $logContent .= "|------|------|-------|----------|\n";
            foreach ($users as $u) {
                $logContent .= "| {$u['name']} | {$u['role']} | {$u['email']} | {$u['password']} |\n";
            }
            $logContent .= "\n";
        }
        
        file_put_contents(base_path('rwandan_users_log.txt'), $logContent);
    }
}
