@extends('layouts.app')

@section('title', 'User')

@section('content')
<div class="flex items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-semibold">Manajemen User</h1>
        <p class="text-sm text-gray-500">Kelola akun pengguna dan role.</p>
    </div>
    <a href="{{ route('users.create') }}"
       class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
        + Tambah User
    </a>
</div>

<div class="mt-6 overflow-x-auto rounded-xl border">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-600">
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Nama</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Role</th>
            <th class="px-4 py-3 w-40">Aksi</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 bg-white">
        @forelse($users as $u)
            <tr class="text-sm">
                <td class="px-4 py-3 text-gray-700">{{ $u->id }}</td>
                <td class="px-4 py-3 font-medium text-gray-900">{{ $u->name }}</td>
                <td class="px-4 py-3 text-gray-700">{{ $u->email }}</td>
                <td class="px-4 py-3">
                    <span class="inline-flex rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-800">
                        {{ $u->role }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('users.edit', $u->id) }}"
                           class="rounded-lg border px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                            Edit
                        </a>
                        <form action="{{ route('users.destroy', $u->id) }}" method="POST"
                              onsubmit="return confirm('Hapus user ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-4 py-10 text-center text-sm text-gray-500">
                    Belum ada user.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@if(method_exists($users, 'links'))
    <div class="mt-4">{{ $users->links() }}</div>
@endif
@endsection
