@extends('layouts.app')

@section('content')
<h2>Data Barang</h2>

<a href="{{ route('barangs.create') }}">+ Tambah Barang</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Batch</th>
            <th>Jumlah</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($barangs as $b)
        <tr>
            <td>{{ $b->ID_Barang }}</td>
            <td>{{ $b->Nama_Barang }}</td>
            <td>{{ $b->Kategori }}</td>
            <td>{{ $b->Nomor_Batch }}</td>
            <td>{{ $b->Jumlah }}</td>
            <td>{{ $b->Lokasi }}</td>
            <td>
                <a href="{{ route('barangs.show', $b->ID_Barang) }}">Detail</a>
                <a href="{{ route('barangs.edit', $b->ID_Barang) }}">Edit</a>
                <form action="{{ route('barangs.destroy', $b->ID_Barang) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus barang?')">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $barangs->links() }}
@endsection
