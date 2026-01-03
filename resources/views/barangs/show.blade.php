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
    @php
        $items = [
            ['label' => 'ID Barang', 'value' => $barang->ID_Barang],
            ['label' => 'Nama Barang', 'value' => $barang->Nama_Barang],
            ['label' => 'Kategori', 'value' => $barang->Kategori],
            ['label' => 'Nomor Batch', 'value' => $barang->Nomor_Batch],
            ['label' => 'Stok', 'value' => $barang->Jumlah],
            ['label' => 'Lokasi', 'value' => $barang->Lokasi],
        ];
    @endphp

    @foreach($items as $it)
        <div class="rounded-xl border p-4">
            <div class="text-xs text-gray-500">{{ $it['label'] }}</div>
            <div class="text-lg font-semibold">{{ $it['value'] }}</div>
        </div>
    @endforeach
</div>
@endsection
