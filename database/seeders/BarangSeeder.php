<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        Barang::insert([
            [
                'Nama_Barang' => 'Botol Plastik 600ml',
                'Kategori' => 'Plastik',
                'Nomor_Batch' => 'BATCH-001',
                'Jumlah' => 100,
                'Lokasi' => 'Gudang A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nama_Barang' => 'Botol Plastik 1L',
                'Kategori' => 'Plastik',
                'Nomor_Batch' => 'BATCH-002',
                'Jumlah' => 75,
                'Lokasi' => 'Gudang B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
