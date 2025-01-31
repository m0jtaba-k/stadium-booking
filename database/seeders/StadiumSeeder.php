<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stadium;
use App\Models\User;

class StadiumSeeder extends Seeder
{
    public function run()
    {
        // Create test owner user
        $owner = User::factory()->create([
            'name' => 'Stadium Owner',
            'email' => 'owner@example.com',
            'role' => 'owner',
            'password' => bcrypt('password')
        ]);

        // Create stadiums
        $stadiums = [
            [
                'name' => 'Camp Nou',
                'address' => 'C. d\'Arístides Maillol, 12, 08028 Barcelona, Spain',
                'capacity' => 99354,
                'price_per_hour' => 2500.00,
                'user_id' => $owner->id
            ],
            [
                'name' => 'Old Trafford',
                'address' => 'Sir Matt Busby Way, Stretford, Manchester M16 0RA, UK',
                'capacity' => 74140,
                'price_per_hour' => 1800.00,
                'user_id' => $owner->id
            ],
            [
                'name' => 'San Siro',
                'address' => 'Piazzale Angelo Moratti, 20151 Milano MI, Italy',
                'capacity' => 80018,
                'price_per_hour' => 2100.00,
                'user_id' => $owner->id
            ]
        ];

        foreach ($stadiums as $stadium) {
            Stadium::create($stadium);
        }

        // Create 5 random stadiums using factory
        Stadium::factory()->count(5)->create([
            'user_id' => $owner->id
        ]);
    }
}