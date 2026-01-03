@extends('layouts.app')

@section('content')
<h2>Tambah Barang</h2>

<form method="POST" action="{{ route('barangs.store') }}">
    @csrf
    <p>Nama Barang<br><input name="Nama_Barang" value="{{ old('Nama_Barang') }}"></p>
    <p>Kategori<br><input name="Kategori" value="{{ old('Kategori') }}"></p>
    <p>Nomor Batch<br><input name="Nomor_Batch" value="{{ old('Nomor_Batch') }}"></p>
    <p>Jumlah<br><input type="number" name="Jumlah" value="{{ old('Jumlah') }}"></p>
    <p>Lokasi<br><input name="Lokasi" value="{{ old('Lokasi') }}"></p>

    <button type="submit">Simpan</button>
</form>
@endsection
