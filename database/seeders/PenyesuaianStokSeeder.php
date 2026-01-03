<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PenyesuaianStok;

class PenyesuaianStokSeeder extends Seeder
{
    public function run(): void
    {
        PenyesuaianStok::insert([
            [
                'ID_Barang' => 1,
                'Jumlah_Penyesuaian' => -5,
                'Alasan' => 'Barang rusak',
                'Tanggal_Penyesuaian' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ID_Barang' => 2,
                'Jumlah_Penyesuaian' => 10,
                'Alasan' => 'Selisih stok opname',
                'Tanggal_Penyesuaian' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
