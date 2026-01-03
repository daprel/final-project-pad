<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laporan;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        Laporan::insert([
            [
                'Tanggal_Laporan' => now(),
                'Total_Masuk' => 20,
                'Total_Keluar' => 10,
                'Total_Penyesuaian' => 5,
                'Jenis_Laporan' => 'Harian',
                'Generated_By' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
