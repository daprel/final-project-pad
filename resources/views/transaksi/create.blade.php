@extends('layouts.app')
@section('content')
<h2>Tambah Transaksi</h2>

<form method="POST" action="{{ route('transaksi.store') }}">
@csrf

<p>
    Departemen <br>
    <input name="Departemen" value="{{ old('Departemen') }}">
</p>

<p>
    Barang <br>
    <select name="ID_Barang">
        @foreach($barangs as $b)
            <option value="{{ $b->ID_Barang }}" {{ old('ID_Barang') == $b->ID_Barang ? 'selected' : '' }}>
                {{ $b->Nama_Barang }} (Batch: {{ $b->Nomor_Batch }})
            </option>
        @endforeach
    </select>
</p>

<p>
    Nomor Batch <br>
    <input name="Nomor_Batch" value="{{ old('Nomor_Batch') }}">
</p>

<p>
    Jumlah <br>
    <input type="number" name="Jumlah" value="{{ old('Jumlah') }}">
</p>

<p>
    Tanggal <br>
    <input type="datetime-local" name="Tanggal" value="{{ old('Tanggal') }}">
</p>

<p>
    Tipe <br>
    <select name="Tipe_Transaksi">
        <option value="Masuk" {{ old('Tipe_Transaksi') == 'Masuk' ? 'selected' : '' }}>Masuk</option>
        <option value="Keluar" {{ old('Tipe_Transaksi') == 'Keluar' ? 'selected' : '' }}>Keluar</option>
    </select>
</p>

<button type="submit">Simpan</button>
</form>
@endsection
