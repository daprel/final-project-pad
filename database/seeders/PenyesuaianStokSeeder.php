<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PenyesuaianStok;
use App\Models\Barang;
use Carbon\Carbon;

class PenyesuaianStokSeeder extends Seeder
{
    public function run(): void
    {
        PenyesuaianStok::truncate();

        $barang = Barang::first();

        PenyesuaianStok::create([
            'ID_Barang' => $barang->ID_Barang,
            'Jumlah_Penyesuaian' => -5,
            'Alasan' => 'Barang rusak',
            'Tanggal_Penyesuaian' => Carbon::now(),
        ]);

        // Update stok
        $barang->decrement('Jumlah', 5);
    }
}
