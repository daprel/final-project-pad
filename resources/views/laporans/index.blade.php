@extends('layouts.app')
@section('content')
<h2>Laporan</h2>
<a href="{{ route('laporans.create') }}">Tambah</a>

<table>
<tr>
<th>ID</th><th>Tanggal</th><th>Jenis</th><th>Aksi</th>
</tr>
@foreach($laporans as $l)
<tr>
<td>{{ $l->ID_Laporan }}</td>
<td>{{ $l->Tanggal_Laporan }}</td>
<td>{{ $l->Jenis_Laporan }}</td>
<td>
<form method="POST" action="{{ route('laporans.destroy',$l->ID_Laporan) }}">
@csrf @method('DELETE')
<button>Hapus</button>
</form>
</td>
</tr>
@endforeach
</table>
@endsection
