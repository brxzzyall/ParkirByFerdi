<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Owner', 'role' => 'owner', 'password' => 'password', 'email_verified_at' => now()]
        );

        // Contoh petugas tambahan
        User::firstOrCreate(
            ['email' => 'petugas1@example.com'],
            ['name' => 'Petugas 1', 'role' => 'petugas', 'password' => 'password', 'email_verified_at' => now()]
        );
    }
}
