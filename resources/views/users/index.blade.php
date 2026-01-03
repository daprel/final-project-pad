@extends('layouts.app')

@section('content')
<h2>Data User</h2>
<a href="{{ route('users.create') }}">Tambah User</a>

<table>
<tr>
    <th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th>
</tr>
@foreach($users as $u)
<tr>
    <td>{{ $u->id }}</td>
    <td>{{ $u->name }}</td>
    <td>{{ $u->email }}</td>
    <td>{{ $u->role }}</td>
    <td>
        <a href="{{ route('users.edit',$u->id) }}">Edit</a>
        <form method="POST" action="{{ route('users.destroy',$u->id) }}" style="display:inline">
            @csrf @method('DELETE')
            <button onclick="return confirm('Hapus user?')">Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</table>

{{ $users->links() }}
@endsection
