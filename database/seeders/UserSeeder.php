<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::truncate();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Supervisor',
            'email' => 'supervisor@example.com',
            'role' => 'supervisor',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Staf',
            'email' => 'staf@example.com',
            'role' => 'staf',
            'password' => Hash::make('password'),
        ]);
    }
}
