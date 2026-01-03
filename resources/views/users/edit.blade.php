@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="flex items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-semibold">Edit User</h1>
        <p class="text-sm text-gray-500">Perbarui data user dan role.</p>
    </div>
    <a href="{{ route('users.index') }}"
       class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
        Kembali
    </a>
</div>

<form class="mt-6 space-y-4" method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="text-sm font-semibold text-gray-700">Nama</label>
            <input name="name" value="{{ old('name', $user->name) }}"
                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700">Email</label>
            <input name="email" value="{{ old('email', $user->email) }}"
                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700">Role</label>
            <select name="role"
                    class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                @foreach(['admin','supervisor','staf'] as $r)
                    <option value="{{ $r }}" {{ old('role', $user->role) == $r ? 'selected' : '' }}>
                        {{ $r }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700">Password (opsional)</label>
            <input type="password" name="password"
                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
            <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengganti password.</p>
        </div>
    </div>

    <div class="pt-2 flex items-center gap-2">
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
            Update
        </button>
        <a href="{{ route('users.index') }}"
           class="rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
            Batal
        </a>
    </div>
</form>
@endsection
