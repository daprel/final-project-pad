<?php

namespace App\Http\Controllers;

use App\Models\TransaksiMasukKeluar;
use App\Models\Barang;
use Illuminate\Http\Request;

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
            'Jumlah'         => 'required|integer',
            'Tanggal'        => 'required|date',
            'Tipe_Transaksi' => 'required|in:Masuk,Keluar',
        ]);

        TransaksiMasukKeluar::create($data);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
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
            'Jumlah'         => 'required|integer',
            'Tanggal'        => 'required|date',
            'Tipe_Transaksi' => 'required|in:Masuk,Keluar',
        ]);

        $trx->update($data);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $trx = TransaksiMasukKeluar::findOrFail($id);
        $trx->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
