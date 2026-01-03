@extends('layouts.app')

@section('title', 'Barang')

@section('content')
<div class="flex items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-semibold">Data Barang</h1>
        <p class="text-sm text-gray-500">Daftar seluruh barang dan stok terkini.</p>
    </div>
    <a href="{{ route('barangs.create') }}"
       class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
        + Tambah Barang
    </a>
</div>

<div class="mt-6 overflow-x-auto rounded-xl border">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-600">
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Nama</th>
            <th class="px-4 py-3">Kategori</th>
            <th class="px-4 py-3">Batch</th>
            <th class="px-4 py-3">Stok</th>
            <th class="px-4 py-3">Lokasi</th>
            <th class="px-4 py-3 w-40">Aksi</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 bg-white">
        @forelse($barangs as $b)
            <tr class="text-sm">
                <td class="px-4 py-3 text-gray-700">{{ $b->ID_Barang }}</td>
                <td class="px-4 py-3 font-medium text-gray-900">{{ $b->Nama_Barang }}</td>
                <td class="px-4 py-3 text-gray-700">{{ $b->Kategori }}</td>
                <td class="px-4 py-3 text-gray-700">{{ $b->Nomor_Batch }}</td>
                <td class="px-4 py-3">
                    <span class="inline-flex rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-800">
                        {{ $b->Jumlah }}
                    </span>
                </td>
                <td class="px-4 py-3 text-gray-700">{{ $b->Lokasi }}</td>
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('barangs.show', $b->ID_Barang) }}"
                           class="rounded-lg border px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                            Detail
                        </a>
                        <a href="{{ route('barangs.edit', $b->ID_Barang) }}"
                           class="rounded-lg border px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                            Edit
                        </a>
                        <form action="{{ route('barangs.destroy', $b->ID_Barang) }}" method="POST"
                              onsubmit="return confirm('Hapus barang ini?')" class="inline">
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
                <td colspan="7" class="px-4 py-10 text-center text-sm text-gray-500">
                    Belum ada data barang.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@if(method_exists($barangs, 'links'))
    <div class="mt-4">{{ $barangs->links() }}</div>
@endif
@endsection
