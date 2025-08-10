<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::where('slug', 'super-admin')->first();
        $adminRole = Role::where('slug', 'admin')->first();
        $userRole = Role::where('slug', 'user')->first();

        // Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_id' => $superAdminRole->id,
            'status' => 'active',
        ]);

        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'status' => 'active',
        ]);

        // Create Regular Users
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'role_id' => $userRole->id,
                'status' => 'active',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'role_id' => $userRole->id,
                'status' => 'active',
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'password' => Hash::make('password'),
                'role_id' => $userRole->id,
                'status' => 'inactive',
            ],
            [
                'name' => 'Alice Brown',
                'email' => 'alice@example.com',
                'password' => Hash::make('password'),
                'role_id' => $userRole->id,
                'status' => 'active',
            ],
        ];

        foreach ($users as $userData) {
            $userData['email_verified_at'] = now();
            User::create($userData);
        }
    }
}