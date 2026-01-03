@extends('layouts.app')
@section('content')
<h2>Tambah Penyesuaian</h2>

<form method="POST" action="{{ route('penyesuaian-stok.store') }}">
@csrf
Barang
<select name="ID_Barang">
@foreach($barangs as $b)
<option value="{{ $b->ID_Barang }}">{{ $b->Nama_Barang }}</option>
@endforeach
</select><br>

Jumlah <input type="number" name="Jumlah_Penyesuaian"><br>
Alasan <input name="Alasan"><br>
Tanggal <input type="datetime-local" name="Tanggal_Penyesuaian"><br>

<button>Simpan</button>
</form>
@endsection
