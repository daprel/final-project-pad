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
            'Nomor_Batch' => 'SEP-BA-001',
            'Jumlah' => 100,
            'Lokasi' => 'Gudang A',
        ]);

        Barang::create([
            'Nama_Barang' => 'Big Cola',
            'Kategori' => '250ml',
            'Nomor_Batch' => 'JAN-FA-001',
            'Jumlah' => 50,
            'Lokasi' => 'Gudang B',
        
        ]);
        Barang::create([
            'Nama_Barang' => 'Fanta',
            'Kategori' => '1500ml',
            'Nomor_Batch' => 'JAN-FD-001',
            'Jumlah' => 25,
            'Lokasi' => 'Gudang B',
        ]);

        Barang::create([
            'Nama_Barang' => 'Pepsi',
            'Kategori' => '250ml',
            'Nomor_Batch' => 'JAN-PA-001',
            'Jumlah' => 150,
            'Lokasi' => 'Gudang C',
        ]);
    }
}
