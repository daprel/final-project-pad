<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransaksiMasukKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiMasukKeluarController extends Controller
{
    public function index()
    {
        $transaksi = TransaksiMasukKeluar::with('barang')->latest()->paginate(10);
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $barangs = Barang::orderBy('Nama_Barang')->get();
        return view('transaksi.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Departemen'     => 'required|string|max:255',
            'ID_Barang'      => 'required|integer|exists:barangs,ID_Barang',
            'Nomor_Batch'    => 'required|string|max:255',
            'Jumlah'         => 'required|integer|min:1',
            'Tanggal'        => 'required|date',
            'Tipe_Transaksi' => 'required|in:Masuk,Keluar',
        ]);

        try {
            DB::transaction(function () use ($data) {
                // lock barang agar stok aman
                $barang = Barang::lockForUpdate()->findOrFail($data['ID_Barang']);

                // cek stok jika keluar
                if ($data['Tipe_Transaksi'] === 'Keluar' && $barang->Jumlah < $data['Jumlah']) {
                    throw new \Exception('Stok tidak cukup untuk transaksi keluar.');
                }

                // simpan transaksi
                TransaksiMasukKeluar::create($data);

                // update stok
                if ($data['Tipe_Transaksi'] === 'Masuk') {
                    $barang->Jumlah += $data['Jumlah'];
                } else {
                    $barang->Jumlah -= $data['Jumlah'];
                }

                $barang->save();
            });

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi berhasil disimpan dan stok terupdate.');
        } catch (\Throwable $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function show($id)
    {
        $trx = TransaksiMasukKeluar::with('barang')->findOrFail($id);
        return view('transaksi.show', compact('trx'));
    }

    public function edit($id)
    {
        $trx = TransaksiMasukKeluar::findOrFail($id);
        $barangs = Barang::orderBy('Nama_Barang')->get();
        return view('transaksi.edit', compact('trx', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $trx = TransaksiMasukKeluar::findOrFail($id);

        $data = $request->validate([
            'Departemen'     => 'required|string|max:255',
            'ID_Barang'      => 'required|integer|exists:barangs,ID_Barang',
            'Nomor_Batch'    => 'required|string|max:255',
            'Jumlah'         => 'required|integer|min:1',
            'Tanggal'        => 'required|date',
            'Tipe_Transaksi' => 'required|in:Masuk,Keluar',
        ]);

        try {
            DB::transaction(function () use ($trx, $data) {

                // 1) rollback efek stok lama
                $oldBarang = Barang::lockForUpdate()->findOrFail($trx->ID_Barang);

                if ($trx->Tipe_Transaksi === 'Masuk') {
                    // dulu nambah, rollback = kurangi
                    if ($oldBarang->Jumlah < $trx->Jumlah) {
                        throw new \Exception('Tidak bisa update: rollback stok lama membuat stok minus.');
                    }
                    $oldBarang->Jumlah -= $trx->Jumlah;
                } else { // Keluar
                    // dulu mengurangi, rollback = tambah
                    $oldBarang->Jumlah += $trx->Jumlah;
                }
                $oldBarang->save();

                // 2) apply efek stok baru (bisa barang berbeda)
                $newBarang = ($data['ID_Barang'] == $trx->ID_Barang)
                    ? $oldBarang
                    : Barang::lockForUpdate()->findOrFail($data['ID_Barang']);

                if ($data['Tipe_Transaksi'] === 'Keluar' && $newBarang->Jumlah < $data['Jumlah']) {
                    throw new \Exception('Stok tidak cukup untuk transaksi keluar (data baru).');
                }

                if ($data['Tipe_Transaksi'] === 'Masuk') {
                    $newBarang->Jumlah += $data['Jumlah'];
                } else {
                    $newBarang->Jumlah -= $data['Jumlah'];
                }
                $newBarang->save();

                // 3) update data transaksi
                $trx->update($data);
            });

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi berhasil diupdate dan stok tersinkron.');
        } catch (\Throwable $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $trx = TransaksiMasukKeluar::findOrFail($id);

        try {
            DB::transaction(function () use ($trx) {
                $barang = Barang::lockForUpdate()->findOrFail($trx->ID_Barang);

                // rollback efek transaksi
                if ($trx->Tipe_Transaksi === 'Masuk') {
                    if ($barang->Jumlah < $trx->Jumlah) {
                        throw new \Exception('Tidak bisa hapus: stok akan menjadi minus.');
                    }
                    $barang->Jumlah -= $trx->Jumlah;
                } else { // Keluar
                    $barang->Jumlah += $trx->Jumlah;
                }

                $barang->save();
                $trx->delete();
            });

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi berhasil dihapus dan stok dikembalikan.');
        } catch (\Throwable $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
