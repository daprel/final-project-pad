<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\PenyesuaianStok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'Jumlah_Penyesuaian'  => 'required|integer', // boleh +/-
            'Alasan'              => 'required|string|max:255',
            'Tanggal_Penyesuaian' => 'required|date',
        ]);

        try {
            DB::transaction(function () use ($data) {
                $barang = Barang::lockForUpdate()->findOrFail($data['ID_Barang']);

                $newStock = $barang->Jumlah + $data['Jumlah_Penyesuaian'];
                if ($newStock < 0) {
                    throw new \Exception('Penyesuaian membuat stok menjadi minus.');
                }

                PenyesuaianStok::create($data);

                $barang->Jumlah = $newStock;
                $barang->save();
            });

            return redirect()->route('penyesuaian-stok.index')
                ->with('success', 'Penyesuaian tersimpan dan stok terupdate.');
        } catch (\Throwable $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
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

        try {
            DB::transaction(function () use ($ps, $data) {

                // 1) rollback penyesuaian lama
                $oldBarang = Barang::lockForUpdate()->findOrFail($ps->ID_Barang);
                $rollbackStock = $oldBarang->Jumlah - $ps->Jumlah_Penyesuaian;

                if ($rollbackStock < 0) {
                    throw new \Exception('Tidak bisa update: rollback penyesuaian lama membuat stok minus.');
                }

                $oldBarang->Jumlah = $rollbackStock;
                $oldBarang->save();

                // 2) apply penyesuaian baru (bisa barang berbeda)
                $newBarang = ($data['ID_Barang'] == $ps->ID_Barang)
                    ? $oldBarang
                    : Barang::lockForUpdate()->findOrFail($data['ID_Barang']);

                $newStock = $newBarang->Jumlah + $data['Jumlah_Penyesuaian'];
                if ($newStock < 0) {
                    throw new \Exception('Penyesuaian baru membuat stok minus.');
                }

                $newBarang->Jumlah = $newStock;
                $newBarang->save();

                // 3) update record penyesuaian
                $ps->update($data);
            });

            return redirect()->route('penyesuaian-stok.index')
                ->with('success', 'Penyesuaian berhasil diupdate dan stok tersinkron.');
        } catch (\Throwable $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $ps = PenyesuaianStok::findOrFail($id);

        try {
            DB::transaction(function () use ($ps) {
                $barang = Barang::lockForUpdate()->findOrFail($ps->ID_Barang);

                // rollback efek penyesuaian
                $newStock = $barang->Jumlah - $ps->Jumlah_Penyesuaian;
                if ($newStock < 0) {
                    throw new \Exception('Tidak bisa hapus: stok akan menjadi minus.');
                }

                $barang->Jumlah = $newStock;
                $barang->save();

                $ps->delete();
            });

            return redirect()->route('penyesuaian-stok.index')
                ->with('success', 'Penyesuaian berhasil dihapus dan stok dikembalikan.');
        } catch (\Throwable $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
