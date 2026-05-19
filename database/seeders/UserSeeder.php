<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $staffRole = Role::where('name', 'Staff')->first();
        $userRole = Role::where('name', 'User')->first();

        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'status' => 'active',
        ]);

        // Staff
        User::create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role_id' => $staffRole->id,
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Demo User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
            'status' => 'active',
        ]);

        // Regular users
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "User {$i}",
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password'),
                'role_id' => $userRole->id,
                'status' => 'active',
            ]);
        }
    }
}
