@extends('layouts.app')
@section('content')
<h2>Transaksi</h2>
<a href="{{ route('transaksi.create') }}">Tambah Transaksi</a>

<table>
<tr>
    <th>ID</th><th>Barang</th><th>Jumlah</th><th>Tipe</th><th>Aksi</th>
</tr>
@foreach($transaksi as $t)
<tr>
    <td>{{ $t->ID_Transaksi }}</td>
    <td>{{ $t->barang->Nama_Barang }}</td>
    <td>{{ $t->Jumlah }}</td>
    <td>{{ $t->Tipe_Transaksi }}</td>
    <td>
        <a href="{{ route('transaksi.edit',$t->ID_Transaksi) }}">Edit</a>
        <form method="POST" action="{{ route('transaksi.destroy',$t->ID_Transaksi) }}" style="display:inline">
            @csrf @method('DELETE')
            <button>Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</table>
@endsection
