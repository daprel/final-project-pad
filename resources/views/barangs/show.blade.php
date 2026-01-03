@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')
<div class="flex items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-semibold">Detail Barang</h1>
        <p class="text-sm text-gray-500">Informasi lengkap barang.</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('barangs.edit', $barang->ID_Barang) }}"
           class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
            Edit
        </a>
        <a href="{{ route('barangs.index') }}"
           class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
            Kembali
        </a>
    </div>
</div>

<div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="rounded-xl border p-4">
        <div class="text-xs text-gray-500">ID Barang</div>
        <div class="text-lg font-semibold">{{ $barang->ID_Barang }}</div>
    </div>

    <div class="rounded-xl border p-4">
        <div class="text-xs text-gray-500">Stok</div>
        <div class="text-lg font-semibold">{{ $barang->Jumlah }}</div>
    </div>

    <div class="rounded-xl border p-4">
        <div class="text-xs text-gray-500">Nama Barang</div>
        <div class="text-lg font-semibold">{{ $barang->Nama_Barang }}</div>
    </div>

    <div class="rounded-xl border p-4">
        <div class="text-xs text-gray-500">Kategori</div>
        <div class="text-lg font-semibold">{{ $barang->Kategori }}</div>
    </div>

    <div class="rounded-xl border p-4">
        <div class="text-xs text-gray-500">Nomor Batch</div>
        <div class="text-lg font-semibold">{{ $barang->Nomor_Batch }}</div>
    </div>

    <div class="rounded-xl border p-4">
        <div class="text-xs text-gray-500">Lokasi</div>
        <div class="text-lg font-semibold">{{ $barang->Lokasi }}</div>
    </div>
</div>
@endsection
