<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransaksiMasukKeluar;
use App\Models\Barang;
use Carbon\Carbon;

class TransaksiMasukKeluarSeeder extends Seeder
{
    public function run(): void
    {
        TransaksiMasukKeluar::truncate();

        $barang = Barang::first();

        // TRANSAKSI MASUK
        TransaksiMasukKeluar::create([
            'Departemen' => 'Gudang',
            'ID_Barang' => $barang->ID_Barang,
            'Nomor_Batch' => $barang->Nomor_Batch,
            'Jumlah' => 20,
            'Tanggal' => Carbon::now(),
            'Tipe_Transaksi' => 'Masuk',
        ]);

        $barang->increment('Jumlah', 20);

        // TRANSAKSI KELUAR
        TransaksiMasukKeluar::create([
            'Departemen' => 'Distribusi',
            'ID_Barang' => $barang->ID_Barang,
            'Nomor_Batch' => $barang->Nomor_Batch,
            'Jumlah' => 10,
            'Tanggal' => Carbon::now(),
            'Tipe_Transaksi' => 'Keluar',
        ]);

        $barang->decrement('Jumlah', 10);
    }
}
