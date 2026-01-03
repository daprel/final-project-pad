@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="flex items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-semibold">Tambah Transaksi</h1>
        <p class="text-sm text-gray-500">Pilih batch, nama barang akan terisi otomatis.</p>
    </div>
    <a href="{{ route('transaksi.index') }}"
       class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
        Kembali
    </a>
</div>

@php
    // mapping batch => detail barang
    $map = $barangs->mapWithKeys(function($b){
        return [$b->Nomor_Batch => [
            'ID_Barang' => $b->ID_Barang,
            'Nama_Barang' => $b->Nama_Barang,
            'Stok' => (int) $b->Jumlah,
            'Kategori' => $b->Kategori,
            'Lokasi' => $b->Lokasi,
        ]];
    });
@endphp

<form class="mt-6 space-y-4" method="POST" action="{{ route('transaksi.store') }}">
    @csrf

    {{-- Hidden ID_Barang yang akan dikirim --}}
    <input type="hidden" name="ID_Barang" id="ID_Barang" value="{{ old('ID_Barang') }}">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="form-label">Departemen</label>
            <input name="Departemen" value="{{ old('Departemen') }}" class="form-input" placeholder="Contoh: Sales">
        </div>

        <div>
            <label class="form-label">Nomor Batch</label>
            <select name="Nomor_Batch" id="Nomor_Batch" class="form-select">
                <option value="">-- Pilih Batch --</option>
                @foreach($barangs as $b)
                    <option value="{{ $b->Nomor_Batch }}" {{ old('Nomor_Batch') == $b->Nomor_Batch ? 'selected' : '' }}>
                        {{ $b->Nomor_Batch }} — {{ $b->Nama_Barang }} (Stok: {{ $b->Jumlah }})
                    </option>
                @endforeach
            </select>
            <p class="form-help">Batch diambil dari tabel barang.</p>
        </div>

        <div>
            <label class="form-label">Nama Barang (otomatis)</label>
            <input id="Nama_Barang" class="form-input bg-gray-50" readonly placeholder="Akan terisi otomatis">
        </div>

        <div>
            <label class="form-label">Stok Saat Ini</label>
            <input id="Stok_Saat_Ini" class="form-input bg-gray-50" readonly placeholder="0">
        </div>

        <div>
            <label class="form-label">Jumlah</label>
            <input type="number" name="Jumlah" value="{{ old('Jumlah', 1) }}" class="form-input" min="1">
        </div>

        <div>
            <label class="form-label">Tanggal</label>
            <input type="datetime-local" name="Tanggal"
                   value="{{ old('Tanggal', now()->format('Y-m-d\TH:i')) }}"
                   class="form-input">
        </div>

        <div>
            <label class="form-label">Tipe Transaksi</label>
            <select name="Tipe_Transaksi" class="form-select">
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

<script>
    const map = @json($map);

    const batchEl = document.getElementById('Nomor_Batch');
    const idBarangEl = document.getElementById('ID_Barang');
    const namaEl = document.getElementById('Nama_Barang');
    const stokEl = document.getElementById('Stok_Saat_Ini');

    function applyBatch(batch) {
        if (!batch || !map[batch]) {
            idBarangEl.value = '';
            namaEl.value = '';
            stokEl.value = '';
            return;
        }

        idBarangEl.value = map[batch].ID_Barang;
        namaEl.value = map[batch].Nama_Barang;
        stokEl.value = map[batch].Stok;
    }

    batchEl.addEventListener('change', (e) => applyBatch(e.target.value));

    // auto apply kalau ada old value (setelah validation error)
    applyBatch(batchEl.value);
</script>
@endsection
