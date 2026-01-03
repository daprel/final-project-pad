<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Inventory')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">
    <header class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-16 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-bold">
                        I
                    </div>
                    <div>
                        <div class="text-sm font-semibold leading-4">Inventory</div>
                        <div class="text-xs text-gray-500 leading-4">Manajemen Stok</div>
                    </div>
                </div>

                <div class="hidden md:flex items-center gap-2">
                    @php
                        $nav = [
                            ['label' => 'Barang', 'route' => 'barangs.index'],
                            ['label' => 'Transaksi', 'route' => 'transaksi.index'],
                            ['label' => 'Penyesuaian', 'route' => 'penyesuaian-stok.index'],
                            ['label' => 'Laporan', 'route' => 'laporans.index'],
                            ['label' => 'User', 'route' => 'users.index'],
                        ];
                    @endphp

                    @foreach($nav as $item)
                        <a href="{{ route($item['route']) }}"
                           @class([
                               'px-3 py-2 rounded-lg text-sm font-medium transition',
                               'bg-indigo-50 text-indigo-700' => request()->routeIs($item['route']),
                               'text-gray-600 hover:text-gray-900 hover:bg-gray-100' => !request()->routeIs($item['route']),
                           ])>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>

                <button id="btnMobileMenu"
                        class="md:hidden inline-flex items-center justify-center p-2 rounded-lg hover:bg-gray-100"
                        aria-label="Open menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            {{-- Mobile menu --}}
            <div id="mobileMenu" class="md:hidden hidden pb-4">
                <div class="pt-2 flex flex-col gap-1">
                    @foreach($nav as $item)
                        <a href="{{ route($item['route']) }}"
                           @class([
                               'px-3 py-2 rounded-lg text-sm font-medium transition',
                               'bg-indigo-50 text-indigo-700' => request()->routeIs($item['route']),
                               'text-gray-600 hover:text-gray-900 hover:bg-gray-100' => !request()->routeIs($item['route']),
                           ])>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        {{-- Flash success --}}
        @if(session('success'))
            <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                <div class="font-semibold">Berhasil</div>
                <div class="text-sm">{{ session('success') }}</div>
            </div>
        @endif

        {{-- Validation errors --}}
        @if($errors->any())
            <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                <div class="font-semibold">Terjadi kesalahan</div>
                <ul class="mt-2 list-disc list-inside text-sm space-y-1">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Page content --}}
        <div class="bg-white rounded-2xl shadow-sm border p-5 sm:p-6">
            @yield('content')
        </div>
    </main>

    <footer class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-xs text-gray-500">
            © {{ date('Y') }} Inventory System
        </div>
    </footer>

    <script>
        const btn = document.getElementById('btnMobileMenu');
        const menu = document.getElementById('mobileMenu');
        if (btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>
