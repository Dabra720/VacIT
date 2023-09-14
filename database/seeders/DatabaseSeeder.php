<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     \App\Models\User::factory(10)->create();

    //     \App\Models\User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);
    // }
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
            'role' => 1
        ]);
        \App\Models\User::create([
            'name' => 'Employer',
            'email' => 'employ@test.com',
            'password' => Hash::make('secret'),
            'role' => 2
        ]);
        \App\Models\User::create([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => Hash::make('secret'),
            'role' => 3
        ]);

        \App\Models\Company::factory(5)->create();

        \App\Models\Joboffer::factory(10)->create();
    }
}
