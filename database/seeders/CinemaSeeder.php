<?php

namespace Database\Seeders;

use App\Models\Cinema;
use Illuminate\Database\Seeder;

class CinemaSeeder extends Seeder
{
    public function run(): void
    {
        $cinemas = [
            [
                'name' => 'Cinema One',
                'address' => '123 Main St',
                'city' => 'Hanoi',
                'latitude' => 21.027763,
                'longitude' => 105.834160,
                'phone' => '0123456789',
                'image' => null,
                'description' => 'Main downtown cinema',
                'status' => 'active',
            ],
            [
                'name' => 'MovieMate Cầu Giấy',
                'address' => 'Cầu Giấy, Hà Nội',
                'city' => 'Hanoi',
                'latitude' => 21.036236,
                'longitude' => 105.790583,
                'phone' => '0241234567',
                'image' => null,
                'description' => 'MovieMate cinema in Cau Giay',
                'status' => 'active',
            ],
            [
                'name' => 'Cinema Two',
                'address' => '456 Second Ave',
                'city' => 'Ho Chi Minh City',
                'latitude' => 10.776889,
                'longitude' => 106.700806,
                'phone' => '0987654321',
                'image' => null,
                'description' => 'City center cinema',
                'status' => 'active',
            ],
            [
                'name' => 'Cinema Three',
                'address' => '789 Third Blvd',
                'city' => 'Da Nang',
                'latitude' => 16.054407,
                'longitude' => 108.202167,
                'phone' => null,
                'image' => null,
                'description' => 'Coastal cinema',
                'status' => 'active',
            ],
        ];

        foreach ($cinemas as $data) {
            Cinema::create($data);
        }
    }
}
