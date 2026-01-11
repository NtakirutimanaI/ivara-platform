<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technical & Repair' => [
                'tag' => 'tech',
                'clients' => [['name' => 'Jean Pierre MUGABO', 'email' => 'mugabo.jp@ivara.com', 'phone' => '0788123456']],
                'providers' => [['name' => 'Alain NIYONZIMA', 'email' => 'niyonzima.alain@ivara.com', 'phone' => '0788654321']]
            ],
            'Creative & Lifestyle' => [
                'tag' => 'clw',
                'clients' => [['name' => 'Clarisse UMUTONI', 'email' => 'umutoni.c@ivara.com', 'phone' => '0788111222']],
                'providers' => [['name' => 'David GAKWAYA', 'email' => 'gakwaya.d@ivara.com', 'phone' => '0788333444']]
            ],
            'Transport & Travel' => [
                'tag' => 'tth',
                'clients' => [['name' => 'Emmanuel HABIMANA', 'email' => 'habimana.e@ivara.com', 'phone' => '0788555666']],
                'providers' => [['name' => 'Fabrice KAMANZI', 'email' => 'kamanzi.f@ivara.com', 'phone' => '0788777888']]
            ],
            'Food, Fashion & Events' => [
                'tag' => 'fef',
                'clients' => [['name' => 'Grace UWAMAHORO', 'email' => 'uwamahoro.g@ivara.com', 'phone' => '0788999000']],
                'providers' => [['name' => 'Honoré RUKUNDO', 'email' => 'rukundo.h@ivara.com', 'phone' => '0782123123']]
            ],
            'Education & Knowledge' => [
                'tag' => 'edu',
                'clients' => [['name' => 'Innocent NTAKIRUTIMANA', 'email' => 'ntakirutimana.i@ivara.com', 'phone' => '0783456456']],
                'providers' => [['name' => 'Julienne MUKARUGWIZA', 'email' => 'mukarugwiza.j@ivara.com', 'phone' => '0784567567']]
            ],
            'Agriculture & Environment' => [
                'tag' => 'agri',
                'clients' => [['name' => 'Kevin KALISA', 'email' => 'kalisa.k@ivara.com', 'phone' => '0785678678']],
                'providers' => [['name' => 'Lydia UMULISA', 'email' => 'umulisa.l@ivara.com', 'phone' => '0786789789']]
            ],
            'Media & Entertainment' => [
                'tag' => 'media',
                'clients' => [['name' => 'Moses IRADUKUNDA', 'email' => 'iradukunda.m@ivara.com', 'phone' => '0787890890']],
                'providers' => [['name' => 'Nancy UWASE', 'email' => 'uwase.n@ivara.com', 'phone' => '0788901901']]
            ],
            'Legal & Professional' => [
                'tag' => 'legal',
                'clients' => [['name' => 'Olivier NDAYISHIMIYE', 'email' => 'ndayishimiye.o@ivara.com', 'phone' => '0789012012']],
                'providers' => [['name' => 'Patricia MUTONIWA', 'email' => 'mutoniwa.p@ivara.com', 'phone' => '0722123456']]
            ],
            'Other Services' => [
                'tag' => 'other',
                'clients' => [['name' => 'Quentin GASANA', 'email' => 'gasana.q@ivara.com', 'phone' => '0733123456']],
                'providers' => [['name' => 'Rose MUKESHIMANA', 'email' => 'mukeshimana.r@ivara.com', 'phone' => '0788123111']]
            ]
        ];

        foreach ($categories as $categoryName => $data) {
            // Seed Clients
            foreach ($data['clients'] as $c) {
                User::updateOrCreate(
                    ['email' => $c['email']],
                    [
                        'name' => $c['name'],
                        'username' => strtolower(explode(' ', $c['name'])[1]) . rand(10, 99),
                        'password' => Hash::make('password'),
                        'role' => 'Client',
                        'category' => $categoryName,
                        'status' => 'online',
                        'phone' => $c['phone'],
                        'country_code' => 'RW - 250',
                    ]
                );
            }

            // Seed Providers
            foreach ($data['providers'] as $p) {
                User::updateOrCreate(
                    ['email' => $p['email']],
                    [
                        'name' => $p['name'],
                        'username' => strtolower(explode(' ', $p['name'])[1]) . rand(10, 99),
                        'password' => Hash::make('password'),
                        'role' => 'Provider',
                        'category' => $categoryName,
                        'status' => 'online',
                        'phone' => $p['phone'],
                        'country_code' => 'RW - 250',
                    ]
                );
            }
        }
    }
}
