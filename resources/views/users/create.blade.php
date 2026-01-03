@extends('layouts.app')

@section('content')
<h2>Tambah User</h2>

<form method="POST" action="{{ route('users.store') }}">
@csrf

<p>
Nama <br>
<input name="name" value="{{ old('name') }}">
</p>

<p>
Email <br>
<input name="email" value="{{ old('email') }}">
</p>

<p>
Role <br>
<select name="role">
    <option value="Supervisor" {{ old('role')=='Supervisor'?'selected':'' }}>Supervisor</option>
    <option value="Staf" {{ old('role')=='Staf'?'selected':'' }}>Staf</option>
</select>
</p>

<p>
Password (opsional) <br>
<input type="password" name="password">
<small>Jika kosong, default: password123</small>
</p>

<button type="submit">Simpan</button>
</form>
@endsection
