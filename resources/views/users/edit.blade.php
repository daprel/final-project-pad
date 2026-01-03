@extends('layouts.app')

@section('content')
<h2>Edit User</h2>

<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <p>
        Nama <br>
        <input name="name" value="{{ old('name', $user->name) }}">
    </p>

    <p>
        Email <br>
        <input name="email" value="{{ old('email', $user->email) }}">
    </p>

    <p>
        Role <br>
        <select name="role">
            <option value="Supervisor" {{ old('role', $user->role) == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
            <option value="Staf" {{ old('role', $user->role) == 'Staf' ? 'selected' : '' }}>Staf</option>
        </select>
    </p>

    <p>
        Password (opsional) <br>
        <input type="password" name="password">
        <br>
        <small>Kosongkan jika tidak ingin mengganti password.</small>
    </p>

    <button type="submit">Update</button>
    <a href="{{ route('users.index') }}">Batal</a>
</form>
@endsection
