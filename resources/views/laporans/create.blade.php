@extends('layouts.app')
@section('content')
<h2>Tambah Laporan</h2>

<form method="POST" action="{{ route('laporans.store') }}">
@csrf
Tanggal <input type="datetime-local" name="Tanggal_Laporan"><br>
Masuk <input type="number" name="Total_Masuk"><br>
Keluar <input type="number" name="Total_Keluar"><br>
Penyesuaian <input type="number" name="Total_Penyesuaian"><br>

Jenis
<select name="Jenis_Laporan">
<option>Harian</option>
<option>Mingguan</option>
<option>Bulanan</option>
<option>Tahunan</option>
</select><br>

<button>Simpan</button>
</form>
@endsection
