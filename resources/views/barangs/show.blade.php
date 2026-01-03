@extends('layouts.app')

@section('content')
<h2>Detail Barang</h2>

<p><b>ID:</b> {{ $barang->ID_Barang }}</p>
<p><b>Nama:</b> {{ $barang->Nama_Barang }}</p>
<p><b>Kategori:</b> {{ $barang->Kategori }}</p>
<p><b>Batch:</b> {{ $barang->Nomor_Batch }}</p>
<p><b>Jumlah:</b> {{ $barang->Jumlah }}</p>
<p><b>Lokasi:</b> {{ $barang->Lokasi }}</p>

<a href="{{ route('barangs.edit', $barang->ID_Barang) }}">Edit</a>
<a href="{{ route('barangs.index') }}">Kembali</a>
@endsection
