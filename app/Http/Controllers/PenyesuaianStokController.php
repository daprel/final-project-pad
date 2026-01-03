<?php

namespace App\Http\Controllers;

use App\Models\PenyesuaianStok;
use App\Models\Barang;
use Illuminate\Http\Request;

class PenyesuaianStokController extends Controller
{
    public function index()
    {
        $penyesuaian = PenyesuaianStok::with('barang')->latest()->paginate(10);
        return view('penyesuaian-stok.index', compact('penyesuaian'));
    }

    public function create()
    {
        $barangs = Barang::orderBy('Nama_Barang')->get();
        return view('penyesuaian-stok.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ID_Barang'           => 'required|integer|exists:barangs,ID_Barang',
            'Jumlah_Penyesuaian'  => 'required|integer',
            'Alasan'              => 'required|string|max:255',
            'Tanggal_Penyesuaian' => 'required|date',
        ]);

        PenyesuaianStok::create($data);

        return redirect()->route('penyesuaian-stok.index')->with('success', 'Penyesuaian stok berhasil ditambahkan.');
    }

    public function show($id)
    {
        $ps = PenyesuaianStok::with('barang')->findOrFail($id);
        return view('penyesuaian-stok.show', compact('ps'));
    }

    public function edit($id)
    {
        $ps = PenyesuaianStok::findOrFail($id);
        $barangs = Barang::orderBy('Nama_Barang')->get();
        return view('penyesuaian-stok.edit', compact('ps', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $ps = PenyesuaianStok::findOrFail($id);

        $data = $request->validate([
            'ID_Barang'           => 'required|integer|exists:barangs,ID_Barang',
            'Jumlah_Penyesuaian'  => 'required|integer',
            'Alasan'              => 'required|string|max:255',
            'Tanggal_Penyesuaian' => 'required|date',
        ]);

        $ps->update($data);

        return redirect()->route('penyesuaian-stok.index')->with('success', 'Penyesuaian stok berhasil diupdate.');
    }

    public function destroy($id)
    {
        $ps = PenyesuaianStok::findOrFail($id);
        $ps->delete();

        return redirect()->route('penyesuaian-stok.index')->with('success', 'Penyesuaian stok berhasil dihapus.');
    }
}
