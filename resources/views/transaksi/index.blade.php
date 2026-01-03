@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
<div class="flex items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-semibold">Transaksi Masuk/Keluar</h1>
        <p class="text-sm text-gray-500">Riwayat transaksi yang mempengaruhi stok barang.</p>
    </div>
    <a href="{{ route('transaksi.create') }}"
       class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
        + Tambah Transaksi
    </a>
</div>

<div class="mt-6 overflow-x-auto rounded-xl border">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-600">
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Tanggal</th>
            <th class="px-4 py-3">Departemen</th>
            <th class="px-4 py-3">Barang</th>
            <th class="px-4 py-3">Batch</th>
            <th class="px-4 py-3">Jumlah</th>
            <th class="px-4 py-3">Tipe</th>
            <th class="px-4 py-3 w-40">Aksi</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 bg-white">
        @forelse($transaksi as $t)
            <tr class="text-sm">
                <td class="px-4 py-3 text-gray-700">{{ $t->ID_Transaksi }}</td>
                <td class="px-4 py-3 text-gray-700">{{ \Carbon\Carbon::parse($t->Tanggal)->format('d/m/Y H:i') }}</td>
                <td class="px-4 py-3 text-gray-700">{{ $t->Departemen }}</td>
                <td class="px-4 py-3 font-medium text-gray-900">
                    {{ $t->barang->Nama_Barang ?? '-' }}
                </td>
                <td class="px-4 py-3 text-gray-700">{{ $t->Nomor_Batch }}</td>
                <td class="px-4 py-3">
                    <span class="inline-flex rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-800">
                        {{ $t->Jumlah }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    @if($t->Tipe_Transaksi === 'Masuk')
                        <span class="inline-flex rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-700">Masuk</span>
                    @else
                        <span class="inline-flex rounded-full bg-red-50 px-2 py-1 text-xs font-semibold text-red-700">Keluar</span>
                    @endif
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('transaksi.edit', $t->ID_Transaksi) }}"
                           class="rounded-lg border px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                            Edit
                        </a>
                        <form action="{{ route('transaksi.destroy', $t->ID_Transaksi) }}" method="POST"
                              onsubmit="return confirm('Hapus transaksi ini? (stok akan dikembalikan)')" class="inline">
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
                <td colspan="8" class="px-4 py-10 text-center text-sm text-gray-500">
                    Belum ada transaksi.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@if(method_exists($transaksi, 'links'))
    <div class="mt-4">{{ $transaksi->links() }}</div>
@endif
@endsection
