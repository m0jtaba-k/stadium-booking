<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
{
    // Admin
    User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin'
    ]);

    // Regular User (stadium creator)
    $user = User::create([
        'name' => 'John Doe',
        'email' => 'user@example.com',
        'password' => bcrypt('password'),
        'role' => 'user'
    ]);

   
   
}
    }

