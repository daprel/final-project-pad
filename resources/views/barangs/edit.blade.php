@extends('layouts.app')

@section('content')
<h2>Edit Barang</h2>

<form method="POST" action="{{ route('barangs.update', $barang->ID_Barang) }}">
    @csrf @method('PUT')
    <p>Nama Barang<br><input name="Nama_Barang" value="{{ old('Nama_Barang', $barang->Nama_Barang) }}"></p>
    <p>Kategori<br><input name="Kategori" value="{{ old('Kategori', $barang->Kategori) }}"></p>
    <p>Nomor Batch<br><input name="Nomor_Batch" value="{{ old('Nomor_Batch', $barang->Nomor_Batch) }}"></p>
    <p>Jumlah<br><input type="number" name="Jumlah" value="{{ old('Jumlah', $barang->Jumlah) }}"></p>
    <p>Lokasi<br><input name="Lokasi" value="{{ old('Lokasi', $barang->Lokasi) }}"></p>

    <button type="submit">Update</button>
</form>
@endsection
