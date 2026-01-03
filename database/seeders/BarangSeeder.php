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
            'Nama_Barang' => 'Big Cola',
            'Kategori' => '600ml',
            'Nomor_Batch' => 'BATCH-001',
            'Jumlah' => 100,
            'Lokasi' => 'Gudang A',
        ]);

        Barang::create([
            'Nama_Barang' => 'Fanta',
            'Kategori' => '1500ml',
            'Nomor_Batch' => 'BATCH-002',
            'Jumlah' => 50,
            'Lokasi' => 'Gudang B',
        ]);
    }
}
