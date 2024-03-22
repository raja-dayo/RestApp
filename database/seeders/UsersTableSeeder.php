<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Example user data
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'session_token' => '4d2e9b0502e1e1be7b0c8783f82c461c7b46ac9afb7896861dd5fc1755adfc9b', // Set session token as needed
            ],
            // Add more users if needed
        ];

        // Insert users into the database
        foreach ($users as $user){
            User::create($user);
        }
    }
}
