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
        $transaksi = TransaksiMasukKeluar::with('barang')
            ->orderByDesc('Tanggal')
            ->paginate(10);

        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $barangs = Barang::orderBy('Nomor_Batch')->get();
        return view('transaksi.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Departemen'     => 'required|string|max:255',
            'Nomor_Batch'    => 'required|string|max:255',
            'ID_Barang'      => 'required|integer|exists:barangs,ID_Barang',
            'Jumlah'         => 'required|integer|min:1',
            'Tanggal'        => 'required|date',
            'Tipe_Transaksi' => 'required|in:Masuk,Keluar',
        ]);

        try {
            DB::transaction(function () use ($data) {
                $barang = Barang::lockForUpdate()->findOrFail($data['ID_Barang']);

                // optional: pastikan batch cocok dengan barang yang dipilih
                if ($barang->Nomor_Batch !== $data['Nomor_Batch']) {
                    throw new \Exception('Nomor batch tidak sesuai dengan barang yang dipilih.');
                }

                if ($data['Tipe_Transaksi'] === 'Keluar' && $barang->Jumlah < $data['Jumlah']) {
                    throw new \Exception('Stok tidak cukup untuk transaksi keluar.');
                }

                TransaksiMasukKeluar::create($data);

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
        $transaksi = TransaksiMasukKeluar::findOrFail($id);
        $barangs = Barang::orderBy('Nomor_Batch')->get();

        return view('transaksi.edit', compact('transaksi', 'barangs'));
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

                // rollback efek stok lama
                $oldBarang = Barang::lockForUpdate()->findOrFail($trx->ID_Barang);

                if ($trx->Tipe_Transaksi === 'Masuk') {
                    if ($oldBarang->Jumlah < $trx->Jumlah) {
                        throw new \Exception('Tidak bisa update: rollback stok lama membuat stok minus.');
                    }
                    $oldBarang->Jumlah -= $trx->Jumlah;
                } else {
                    $oldBarang->Jumlah += $trx->Jumlah;
                }
                $oldBarang->save();

                // apply efek stok baru
                $newBarang = ($data['ID_Barang'] == $trx->ID_Barang)
                    ? $oldBarang
                    : Barang::lockForUpdate()->findOrFail($data['ID_Barang']);

                // optional: pastikan batch cocok
                if ($newBarang->Nomor_Batch !== $data['Nomor_Batch']) {
                    throw new \Exception('Nomor batch tidak sesuai dengan barang yang dipilih.');
                }

                if ($data['Tipe_Transaksi'] === 'Keluar' && $newBarang->Jumlah < $data['Jumlah']) {
                    throw new \Exception('Stok tidak cukup untuk transaksi keluar (data baru).');
                }

                if ($data['Tipe_Transaksi'] === 'Masuk') {
                    $newBarang->Jumlah += $data['Jumlah'];
                } else {
                    $newBarang->Jumlah -= $data['Jumlah'];
                }
                $newBarang->save();

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

                if ($trx->Tipe_Transaksi === 'Masuk') {
                    if ($barang->Jumlah < $trx->Jumlah) {
                        throw new \Exception('Tidak bisa hapus: stok akan menjadi minus.');
                    }
                    $barang->Jumlah -= $trx->Jumlah;
                } else {
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
