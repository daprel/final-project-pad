@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="flex items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-semibold">Tambah Barang</h1>
        <p class="text-sm text-gray-500">Masukkan informasi barang dan stok awal.</p>
    </div>
    <a href="{{ route('barangs.index') }}"
       class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
        Kembali
    </a>
</div>

<form class="mt-6 space-y-4" method="POST" action="{{ route('barangs.store') }}">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="text-sm font-semibold text-gray-700">Nama Barang</label>
            <input name="Nama_Barang" value="{{ old('Nama_Barang') }}"
                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Contoh: Botol Air Mineral">
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700">Kategori</label>
            <input name="Kategori" value="{{ old('Kategori') }}"
                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Contoh: Plastik">
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700">Nomor Batch</label>
            <input name="Nomor_Batch" value="{{ old('Nomor_Batch') }}"
                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Contoh: BATCH-001">
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700">Stok (Jumlah)</label>
            <input type="number" name="Jumlah" value="{{ old('Jumlah', 0) }}"
                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div class="md:col-span-2">
            <label class="text-sm font-semibold text-gray-700">Lokasi</label>
            <input name="Lokasi" value="{{ old('Lokasi') }}"
                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Contoh: Rak A1">
        </div>
    </div>

    <div class="pt-2 flex items-center gap-2">
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
            Simpan
        </button>
        <a href="{{ route('barangs.index') }}"
           class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
            Batal
        </a>
    </div>
</form>
@endsection
