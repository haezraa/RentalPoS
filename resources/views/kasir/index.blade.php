<!DOCTYPE html>
<html>
<head>
    <title>RentalPoS - Kasir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #0f172a;
            color: #fff;
            padding: 20px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        .card {
            padding: 20px;
            border-radius: 12px;
            background: #1e293b;
        }
        .available { border: 2px solid #22c55e; }
        .playing { border: 2px solid #eab308; }
        .maintenance { border: 2px solid #ef4444; }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
        }
        .available .badge { background: #22c55e; }
        .playing .badge { background: #eab308; }
        .maintenance .badge { background: #ef4444; }
    </style>
</head>
<body>

<h1>🎮 Kasir - RentalPoS</h1>

<div class="grid">
@foreach($psUnits as $ps)
    <div class="card {{ $ps->status }}">
        <h2>{{ $ps->nama_ps }}</h2>
        <p>Tipe: {{ $ps->tipe_ps }}</p>
        <p>Rp {{ number_format($ps->harga_per_jam) }} / jam</p>
        <span class="badge">{{ ucfirst($ps->status) }}</span>
    </div>
@endforeach
</div>

</body>
</html>
