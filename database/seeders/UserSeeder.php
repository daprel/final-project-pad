<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'Nama' => 'Supervisor Gudang',
                'Email' => 'supervisor@gudang.com',
                'Role' => 'Supervisor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nama' => 'Staf Gudang',
                'Email' => 'staf@gudang.com',
                'Role' => 'Staf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
