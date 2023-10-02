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
        $roles = [
            'ADMIN',
            'EMPLOYER',
            'CANDIDATE',
        ];

        foreach($roles as $role){
            \App\Models\Role::create([
                'name' => $role,
            ]);
        }
        

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
            'role_id' => 1
        ]);
        \App\Models\User::create([
            'name' => 'Employer',
            'email' => 'employ@test.com',
            'password' => Hash::make('secret'),
            'role_id' => 2,
            'company_id' => 4
        ]);
        \App\Models\User::create([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => Hash::make('secret'),
            'role_id' => 3,
            'profile_id' => 1
        ]);

        \App\Models\Company::factory(5)->create();

        \App\Models\Joboffer::factory(10)->create();

        \App\Models\UserProfile::create([
            'user_id' => 3,
            'name' => 'User',
            'surname' => 'Test',
            'date_of_birth' => fake()->date(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'postcode' => fake()->postcode(),
            'city' => fake()->city(),
            'image' => 'images/profile_pic.jpg'
        ]);

    }
}
