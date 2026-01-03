@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="flex items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-semibold">Edit Barang</h1>
        <p class="text-sm text-gray-500">Perbarui data barang.</p>
    </div>
    <a href="{{ route('barangs.index') }}"
       class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
        Kembali
    </a>
</div>

<form class="mt-6 space-y-4" method="POST" action="{{ route('barangs.update', $barang->ID_Barang) }}">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="form-label">Nama Barang</label>
            <input name="Nama_Barang" value="{{ old('Nama_Barang', $barang->Nama_Barang) }}" class="form-input">
        </div>

        <div>
            <label class="form-label">Kategori</label>
            <input name="Kategori" value="{{ old('Kategori', $barang->Kategori) }}" class="form-input">
        </div>

        <div>
            <label class="form-label">Nomor Batch</label>
            <input name="Nomor_Batch" value="{{ old('Nomor_Batch', $barang->Nomor_Batch) }}" class="form-input">
        </div>

        <div>
            <label class="form-label">Stok (Jumlah)</label>
            <input type="number" name="Jumlah" value="{{ old('Jumlah', $barang->Jumlah) }}" class="form-input" min="0">
            <p class="form-help">Stok juga akan berubah melalui transaksi & penyesuaian.</p>
        </div>

        <div class="md:col-span-2">
            <label class="form-label">Lokasi</label>
            <input name="Lokasi" value="{{ old('Lokasi', $barang->Lokasi) }}" class="form-input">
        </div>
    </div>

    <div class="pt-2 flex items-center gap-2">
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
            Update
        </button>
        <a href="{{ route('barangs.index') }}"
           class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
            Batal
        </a>
    </div>
</form>
@endsection
