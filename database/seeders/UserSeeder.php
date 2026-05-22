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
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        $userRole = Role::firstOrCreate(['name' => 'User']);

        User::updateOrCreate(['email' => 'admin@example.com'], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'status' => 'active',
        ]);

        User::updateOrCreate(['email' => 'staff@example.com'], [
            'name' => 'Staff User',
            'password' => Hash::make('password'),
            'role_id' => $staffRole->id,
            'status' => 'active',
        ]);

        User::updateOrCreate(['email' => 'user@example.com'], [
            'name' => 'Demo User',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
            'status' => 'active',
        ]);

        // Regular users
        for ($i = 1; $i <= 5; $i++) {
            User::updateOrCreate(['email' => "user{$i}@example.com"], [
                'name' => "User {$i}",
                'password' => Hash::make('password'),
                'role_id' => $userRole->id,
                'status' => 'active',
            ]);
        }
    }
}
