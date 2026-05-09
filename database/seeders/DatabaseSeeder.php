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

            // Create an admin user
            User::create([
                'name' => 'Admin Ratih',
                'email' => 'nurfaidaratih@gmail.com',
                'password' => bcrypt('password123'),
                'role' => 'admin',
                'no_telepon' => '081234567890',
            ]);
    }
}
