<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@royalark.edu.ng'],
            [
                'name' => 'Mrs. M. Adeyemi',
                'password' => Hash::make('password123'),
                'user_type' => UserType::ADMIN,
                'email_verified_at' => now(),
            ]
        );

        // Staff
        User::updateOrCreate(
            ['email' => 'staff@royalark.edu.ng'],
            [
                'name' => 'Mr. John Staff',
                'password' => Hash::make('password123'),
                'user_type' => UserType::STAFF,
                'email_verified_at' => now(),
            ]
        );

        // Bursar
        User::updateOrCreate(
            ['email' => 'bursar@royalark.edu.ng'],
            [
                'name' => 'Mrs. Bola Bursar',
                'password' => Hash::make('password123'),
                'user_type' => UserType::BURSAR,
                'email_verified_at' => now(),
            ]
        );
    }
}
