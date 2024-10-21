<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('testingmasuk'),
            'user_role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('testingmasuk'),
            'user_role' => 'customer',
            'email_verified_at' => now()
        ]);

        User::factory()->create([
            'name' => 'Finance',
            'email' => 'finance@gmail.com',
            'password' => Hash::make('testingmasuk'),
            'user_role' => 'finance',
        ]);

        User::factory()->create([
            'name' => 'Operation',
            'email' => 'operation@gmail.com',
            'password' => Hash::make('testingmasuk'),
            'user_role' => 'operation',
        ]);
    }
}
