@extends('layouts.app')

@section('title', 'Tambah Penyesuaian')

@section('content')
<div class="flex items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-semibold">Tambah Penyesuaian Stok</h1>
        <p class="text-sm text-gray-500">Nilai bisa positif atau negatif.</p>
    </div>
    <a href="{{ route('penyesuaian-stok.index') }}"
       class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
        Kembali
    </a>
</div>

<form class="mt-6 space-y-4" method="POST" action="{{ route('penyesuaian-stok.store') }}">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="form-label">Barang</label>
            <select name="ID_Barang" class="form-select">
                <option value="">-- Pilih Barang --</option>
                @foreach($barangs as $b)
                    <option value="{{ $b->ID_Barang }}" {{ old('ID_Barang') == $b->ID_Barang ? 'selected' : '' }}>
                        {{ $b->Nama_Barang }} (Stok: {{ $b->Jumlah }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="form-label">Jumlah Penyesuaian</label>
            <input type="number" name="Jumlah_Penyesuaian" value="{{ old('Jumlah_Penyesuaian', 0) }}" class="form-input">
            <p class="form-help">Contoh: 10 (tambah), -5 (kurang).</p>
        </div>

        <div class="md:col-span-2">
            <label class="form-label">Alasan</label>
            <input name="Alasan" value="{{ old('Alasan') }}" class="form-input" placeholder="Contoh: audit stok, rusak, selisih opname">
        </div>

        <div>
            <label class="form-label">Tanggal Penyesuaian</label>
            <input type="datetime-local" name="Tanggal_Penyesuaian"
                   value="{{ old('Tanggal_Penyesuaian', now()->format('Y-m-d\TH:i')) }}"
                   class="form-input">
        </div>
    </div>

    <div class="pt-2 flex items-center gap-2">
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
            Simpan
        </button>
        <a href="{{ route('penyesuaian-stok.index') }}"
           class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
            Batal
        </a>
    </div>
</form>
@endsection
