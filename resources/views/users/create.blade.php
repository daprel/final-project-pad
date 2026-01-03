@extends('layouts.app')
@section('content')
<h2>Tambah User</h2>

<form method="POST" action="{{ route('users.store') }}">
@csrf
Nama <input name="Nama"><br>
Email <input name="Email"><br>
Role
<select name="Role">
<option>Supervisor</option>
<option>Staf</option>
</select><br>

<button>Simpan</button>
</form>
@endsection
