<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Optionally keep or remove this
        // User::factory(10)->create();

        // Optional direct user creation
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // ✅ This line executes the UserSeeder
        $this->call([
            UserSeeder::class,
            UomSeeder::class,
        ]);
    }
}
