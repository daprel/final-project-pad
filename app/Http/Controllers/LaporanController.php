<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::with('user')->latest()->paginate(10);
        return view('laporans.index', compact('laporans'));
    }

    public function create()
    {
        $users = User::orderBy('Nama')->get();
        return view('laporans.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Tanggal_Laporan'    => 'required|date',
            'Total_Masuk'        => 'required|integer',
            'Total_Keluar'       => 'required|integer',
            'Total_Penyesuaian'  => 'required|integer',
            'Jenis_Laporan'      => 'required|in:Harian,Mingguan,Bulanan,Tahunan',
            'Generated_By'       => 'nullable|integer|exists:users,ID_User',
        ]);

        Laporan::create($data);

        return redirect()->route('laporans.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $laporan = Laporan::with('user')->findOrFail($id);
        return view('laporans.show', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        $users = User::orderBy('Nama')->get();
        return view('laporans.edit', compact('laporan', 'users'));
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $data = $request->validate([
            'Tanggal_Laporan'    => 'required|date',
            'Total_Masuk'        => 'required|integer',
            'Total_Keluar'       => 'required|integer',
            'Total_Penyesuaian'  => 'required|integer',
            'Jenis_Laporan'      => 'required|in:Harian,Mingguan,Bulanan,Tahunan',
            'Generated_By'       => 'nullable|integer|exists:users,ID_User',
        ]);

        $laporan->update($data);

        return redirect()->route('laporans.index')->with('success', 'Laporan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('laporans.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
