<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users
        $users = User::factory(5)->create();

        // Create an admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Create posts for users
        $users->each(function ($user) {
            Post::factory(rand(2, 5))->create([
                'user_id' => $user->id,
            ]);
        });

        // Create posts for admin
        $admin = User::where('email', 'admin@example.com')->first();
        Post::factory(3)->create([
            'user_id' => $admin->id,
        ]);
    }
}