<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::latest()->paginate(10);
        return view('barangs.index', compact('barangs'));
    }

    public function create()
    {
        return view('barangs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Nama_Barang' => 'required|string|max:255',
            'Kategori'    => 'required|string|max:255',
            'Nomor_Batch' => 'required|string|max:255',
            'Jumlah'      => 'required|integer',
            'Lokasi'      => 'required|string|max:255',
        ]);

        Barang::create($data);

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show($id)
    {
        $barang = Barang::with(['transaksi', 'penyesuaian'])->findOrFail($id);
        return view('barangs.show', compact('barang'));
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barangs.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $data = $request->validate([
            'Nama_Barang' => 'required|string|max:255',
            'Kategori'    => 'required|string|max:255',
            'Nomor_Batch' => 'required|string|max:255',
            'Jumlah'      => 'required|integer',
            'Lokasi'      => 'required|string|max:255',
        ]);

        $barang->update($data);

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}
