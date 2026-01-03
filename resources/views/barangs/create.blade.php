@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
@php
    $kategoriOptions = ['250ml','600ml','1000ml','1500ml'];
    $lokasiOptions = ['Gudang A','Gudang B','Gudang C','Gudang D'];
@endphp

<div class="flex items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-semibold">Tambah Barang</h1>
        <p class="text-sm text-gray-500">Masukkan data barang dan stok awal.</p>
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
            <label class="form-label">Nama Barang</label>
            <input name="Nama_Barang"
                   value="{{ old('Nama_Barang') }}"
                   class="form-input"
                   placeholder="Contoh: Pepsi">
        </div>

        <div>
            <label class="form-label">Kategori</label>
            <select name="Kategori" class="form-select">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoriOptions as $opt)
                    <option value="{{ $opt }}" {{ old('Kategori') === $opt ? 'selected' : '' }}>
                        {{ $opt }}
                    </option>
                @endforeach
            </select>
            <p class="form-help">Pilih ukuran botol.</p>
        </div>

        <div>
            <label class="form-label">Nomor Batch</label>
            <input name="Nomor_Batch"
                   value="{{ old('Nomor_Batch') }}"
                   class="form-input"
                   placeholder="Contoh: SEP-CA-001">
        </div>

        <div>
            <label class="form-label">Stok (Jumlah)</label>
            <input type="number"
                   name="Jumlah"
                   value="{{ old('Jumlah', 0) }}"
                   class="form-input"
                   min="0">
        </div>

        <div class="md:col-span-2">
            <label class="form-label">Lokasi</label>
            <select name="Lokasi" class="form-select">
                <option value="">-- Pilih Lokasi --</option>
                @foreach($lokasiOptions as $opt)
                    <option value="{{ $opt }}" {{ old('Lokasi') === $opt ? 'selected' : '' }}>
                        {{ $opt }}
                    </option>
                @endforeach
            </select>
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