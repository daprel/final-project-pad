<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory</title>
    <style>
        body{font-family:Arial; margin:20px;}
        a{margin-right:10px;}
        table{border-collapse:collapse; width:100%;}
        th,td{border:1px solid #ddd; padding:8px;}
        th{background:#f4f4f4;}
        .alert{padding:10px; margin:10px 0; background:#e7ffe7; border:1px solid #b6ffb6;}
        .err{padding:10px; margin:10px 0; background:#ffe7e7; border:1px solid #ffb6b6;}
    </style>
</head>
<body>

<nav>
    <a href="{{ route('barangs.index') }}">Barang</a>
    <a href="{{ route('transaksi.index') }}">Transaksi</a>
    <a href="{{ route('penyesuaian-stok.index') }}">Penyesuaian</a>
    <a href="{{ route('laporans.index') }}">Laporan</a>
    <a href="{{ route('users.index') }}">User</a>
</nav>

@if(session('success'))
    <div class="alert">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="err">
        <ul>
            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
@endif

@yield('content')

</body>
</html>
