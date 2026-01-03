@extends('layouts.app')

@section('title', 'Buat Laporan')

@section('content')
<div class="flex items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-semibold">Buat Laporan</h1>
        <p class="text-sm text-gray-500">Isi ringkasan laporan.</p>
    </div>
    <a href="{{ route('laporans.index') }}"
       class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
        Kembali
    </a>
</div>

<form class="mt-6 space-y-4" method="POST" action="{{ route('laporans.store') }}">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="form-label">Tanggal Laporan</label>
            <input type="datetime-local" name="Tanggal_Laporan"
                   value="{{ old('Tanggal_Laporan', now()->format('Y-m-d\TH:i')) }}"
                   class="form-input">
        </div>

        <div>
            <label class="form-label">Jenis Laporan</label>
            <select name="Jenis_Laporan" class="form-select">
                @foreach(['Harian','Mingguan','Bulanan','Tahunan'] as $j)
                    <option value="{{ $j }}" {{ old('Jenis_Laporan') == $j ? 'selected' : '' }}>{{ $j }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="form-label">Total Masuk</label>
            <input type="number" name="Total_Masuk" value="{{ old('Total_Masuk', 0) }}" class="form-input" min="0">
        </div>

        <div>
            <label class="form-label">Total Keluar</label>
            <input type="number" name="Total_Keluar" value="{{ old('Total_Keluar', 0) }}" class="form-input" min="0">
        </div>

        <div class="md:col-span-2">
            <label class="form-label">Total Penyesuaian</label>
            <input type="number" name="Total_Penyesuaian" value="{{ old('Total_Penyesuaian', 0) }}" class="form-input">
        </div>
    </div>

    <div class="pt-2 flex items-center gap-2">
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
            Simpan
        </button>
        <a href="{{ route('laporans.index') }}"
           class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
            Batal
        </a>
    </div>
</form>
@endsection
