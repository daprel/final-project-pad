<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransaksiMasukKeluar;

class TransaksiMasukKeluarSeeder extends Seeder
{
    public function run(): void
    {
        TransaksiMasukKeluar::insert([
            [
                'Departemen' => 'Produksi',
                'ID_Barang' => 1,
                'Nomor_Batch' => 'BATCH-001',
                'Jumlah' => 20,
                'Tanggal' => now(),
                'Tipe_Transaksi' => 'Masuk',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Departemen' => 'Distribusi',
                'ID_Barang' => 2,
                'Nomor_Batch' => 'BATCH-002',
                'Jumlah' => 10,
                'Tanggal' => now(),
                'Tipe_Transaksi' => 'Keluar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
