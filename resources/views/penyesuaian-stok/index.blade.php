@extends('layouts.app')
@section('content')
<h2>Penyesuaian Stok</h2>
<a href="{{ route('penyesuaian-stok.create') }}">Tambah</a>

<table>
<tr>
<th>ID</th><th>Barang</th><th>Jumlah</th><th>Aksi</th>
</tr>
@foreach($penyesuaian as $p)
<tr>
<td>{{ $p->ID_Penyesuaian }}</td>
<td>{{ $p->barang->Nama_Barang }}</td>
<td>{{ $p->Jumlah_Penyesuaian }}</td>
<td>
<form method="POST" action="{{ route('penyesuaian-stok.destroy',$p->ID_Penyesuaian) }}">
@csrf @method('DELETE')
<button>Hapus</button>
</form>
</td>
</tr>
@endforeach
</table>
@endsection
