<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'username' => 'admin1', // ✅ Added username
            'password' => Hash::make('password123'),
            'usertype' => 'admin',
            'profile_picture' => null,
        ]);

        // Add more users if needed
    }
}
