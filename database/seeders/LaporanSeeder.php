<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laporan;
use Carbon\Carbon;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        Laporan::truncate();

        Laporan::create([
            'Tanggal_Laporan' => Carbon::now(),
            'Total_Masuk' => 20,
            'Total_Keluar' => 10,
            'Total_Penyesuaian' => -5,
            'Jenis_Laporan' => 'Harian',
        ]);
    }
}
