@extends('layouts.app')
@section('content')
<h2>User</h2>
<a href="{{ route('users.create') }}">Tambah</a>

<table>
<tr>
<th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th>
</tr>
@foreach($users as $u)
<tr>
<td>{{ $u->ID_User }}</td>
<td>{{ $u->Nama }}</td>
<td>{{ $u->Email }}</td>
<td>{{ $u->Role }}</td>
<td>
<form method="POST" action="{{ route('users.destroy',$u->ID_User) }}">
@csrf @method('DELETE')
<button>Hapus</button>
</form>
</td>
</tr>
@endforeach
</table>
@endsection
