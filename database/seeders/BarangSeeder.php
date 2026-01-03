<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        Barang::truncate();

        Barang::create([
            'Nama_Barang' => 'Botol Plastik 600ml',
            'Kategori' => 'Plastik',
            'Nomor_Batch' => 'BATCH-001',
            'Jumlah' => 100,
            'Lokasi' => 'Gudang A',
        ]);

        Barang::create([
            'Nama_Barang' => 'Botol Plastik 1500ml',
            'Kategori' => 'Plastik',
            'Nomor_Batch' => 'BATCH-002',
            'Jumlah' => 50,
            'Lokasi' => 'Gudang B',
        ]);
    }
}
