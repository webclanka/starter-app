<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'description' => 'Has access to all system features and settings',
                'permissions' => [
                    'users.view', 'users.create', 'users.edit', 'users.delete',
                    'roles.view', 'roles.create', 'roles.edit', 'roles.delete'
                ]
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Can manage users and basic system settings',
                'permissions' => [
                    'users.view', 'users.create', 'users.edit', 'users.delete',
                    'roles.view'
                ]
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Can manage users within their department',
                'permissions' => [
                    'users.view', 'users.edit'
                ]
            ],
            [
                'name' => 'User',
                'slug' => 'user',
                'description' => 'Standard user with basic access',
                'permissions' => [
                    'users.view'
                ]
            ],
            [
                'name' => 'Subscriber',
                'slug' => 'subscriber',
                'description' => 'Limited access subscriber',
                'permissions' => []
            ],
        ];

        foreach ($roles as $roleData) {
            Role::create($roleData);
        }
    }
}