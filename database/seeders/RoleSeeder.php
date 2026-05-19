<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['Admin', 'Staff', 'User'];

        foreach ($roles as $name) {
            Role::create(['name' => $name]);
        }
    }
}