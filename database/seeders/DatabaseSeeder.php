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
        //$this->call(RolesAndPermissionsSeeder::class);
         \App\Models\User::factory()->count(1)->create()->each(function($user){
             $user->assignRole('super-admin');
         });
        \App\Models\User::factory()->count(1)->create()->each(function($user){
            $user->assignRole('moderator');
        });
        \App\Models\User::factory()->count(1)->create()->each(function($user){
            $user->assignRole('simple-user');
        });

        // \App\Models\User::factory()->create([
          //   'name' => 'Test User',
            // 'email' => 'test@example.com',
        // ]);
    }
}
