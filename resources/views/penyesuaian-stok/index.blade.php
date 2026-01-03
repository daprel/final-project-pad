@extends('layouts.app')

@section('title', 'Penyesuaian Stok')

@section('content')
<div class="flex items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-semibold">Penyesuaian Stok</h1>
        <p class="text-sm text-gray-500">Koreksi stok (bisa plus/minus) beserta alasan.</p>
    </div>
    <a href="{{ route('penyesuaian-stok.create') }}"
       class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
        + Tambah Penyesuaian
    </a>
</div>

<div class="mt-6 overflow-x-auto rounded-xl border">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-600">
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Tanggal</th>
            <th class="px-4 py-3">Barang</th>
            <th class="px-4 py-3">Jumlah</th>
            <th class="px-4 py-3">Alasan</th>
            <th class="px-4 py-3 w-40">Aksi</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 bg-white">
        @forelse($penyesuaian as $ps)
            <tr class="text-sm">
                <td class="px-4 py-3 text-gray-700">{{ $ps->ID_Penyesuaian }}</td>
                <td class="px-4 py-3 text-gray-700">{{ \Carbon\Carbon::parse($ps->Tanggal_Penyesuaian)->format('d/m/Y H:i') }}</td>
                <td class="px-4 py-3 font-medium text-gray-900">{{ $ps->barang->Nama_Barang ?? '-' }}</td>
                <td class="px-4 py-3">
                    @php $v = (int)$ps->Jumlah_Penyesuaian; @endphp
                    @if($v >= 0)
                        <span class="inline-flex rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-700">+{{ $v }}</span>
                    @else
                        <span class="inline-flex rounded-full bg-red-50 px-2 py-1 text-xs font-semibold text-red-700">{{ $v }}</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-gray-700">{{ $ps->Alasan }}</td>
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('penyesuaian-stok.edit', $ps->ID_Penyesuaian) }}"
                           class="rounded-lg border px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                            Edit
                        </a>
                        <form action="{{ route('penyesuaian-stok.destroy', $ps->ID_Penyesuaian) }}" method="POST"
                              onsubmit="return confirm('Hapus penyesuaian ini? (stok akan dikembalikan)')" class="inline">
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
                <td colspan="6" class="px-4 py-10 text-center text-sm text-gray-500">
                    Belum ada data penyesuaian.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@if(method_exists($penyesuaian, 'links'))
    <div class="mt-4">{{ $penyesuaian->links() }}</div>
@endif
@endsection
