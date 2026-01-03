@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="flex items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-semibold">Tambah Transaksi</h1>
        <p class="text-sm text-gray-500">Transaksi masuk/keluar akan otomatis mengubah stok barang.</p>
    </div>
    <a href="{{ route('transaksi.index') }}"
       class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
        Kembali
    </a>
</div>

<form class="mt-6 space-y-4" method="POST" action="{{ route('transaksi.store') }}">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="text-sm font-semibold text-gray-700">Departemen</label>
            <input name="Departemen" value="{{ old('Departemen') }}"
                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Contoh: Sales / Warehouse">
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700">Barang</label>
            <select name="ID_Barang"
                    class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">-- Pilih Barang --</option>
                @foreach($barangs as $b)
                    <option value="{{ $b->ID_Barang }}" {{ old('ID_Barang') == $b->ID_Barang ? 'selected' : '' }}>
                        {{ $b->Nama_Barang }} (Stok: {{ $b->Jumlah }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700">Nomor Batch</label>
            <input name="Nomor_Batch" value="{{ old('Nomor_Batch') }}"
                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Contoh: BATCH-001">
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700">Jumlah</label>
            <input type="number" name="Jumlah" value="{{ old('Jumlah', 1) }}"
                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" min="1">
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700">Tanggal</label>
            <input type="datetime-local" name="Tanggal"
                   value="{{ old('Tanggal', now()->format('Y-m-d\TH:i')) }}"
                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700">Tipe Transaksi</label>
            <select name="Tipe_Transaksi"
                    class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <option value="Masuk" {{ old('Tipe_Transaksi') == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                <option value="Keluar" {{ old('Tipe_Transaksi') == 'Keluar' ? 'selected' : '' }}>Keluar</option>
            </select>
        </div>
    </div>

    <div class="pt-2 flex items-center gap-2">
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
            Simpan
        </button>
        <a href="{{ route('transaksi.index') }}"
           class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
            Batal
        </a>
    </div>
</form>
@endsection
