<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\School::factory(5)->create();
        \App\Models\Student::factory(10)->create([
            'school_id' => 1
        ]);
         \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@firmafy.com',
             'password' => 'password',
             'email_verified_at' => now(),
         ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
