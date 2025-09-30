<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f8f8f8;
            margin: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #e0e0e0;
        }
        a.button, button {
            padding: 5px 10px;
            margin-right: 5px;
            text-decoration: none;
            border: 1px solid #888;
            background-color: #f0f0f0;
            color: #000;
            cursor: pointer;
        }
        a.button:hover, button:hover {
            background-color: #ddd;
        }
        form input, form select {
            padding: 5px;
            margin-right: 5px;
        }
        .stats {
            display: flex;
            gap: 10px;
        }
        .stat-card {
            flex: 1;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Daftar Buku</h2>
<a href="{{ route('create') }}" class="button">+ Tambah Buku</a>

<!-- Form Pencarian -->
<form method="GET" style="margin: 15px 0;">
    <input type="text" name="judul_buku" placeholder="Cari Judul" value="{{ request('judul_buku') }}">
    <select name="penulis">
        <option value="">-- Semua Penulis --</option>
        @foreach($daftar_penulis as $penulis)
            <option value="{{ $penulis }}" {{ request('penulis') == $penulis ? 'selected' : '' }}>
                {{ $penulis }}
            </option>
        @endforeach
    </select>
    <button type="submit">Cari</button>
    <a href="{{ url()->current() }}" class="button">Reset</a>
    <button type="submit" name="show_latest" value="1">5 Terbaru</button>
</form>

<!-- Tabel Buku -->
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tanggal Terbit</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data_buku as $buku)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $buku->judul_buku }}</td>
            <td>{{ $buku->penulis }}</td>
            <td>{{ $buku->tanggal_terbit }}</td>
            <td>Rp{{ number_format($buku->harga, 0, ',', '.') }}</td>
            <td>
                <a href="{{ route('buku.edit', $buku->id) }}" class="button">Edit</a>
                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align:center;">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Statistik Buku -->
<div class="stats">
    <div class="stat-card">
        <div>Total Buku</div>
        <strong>{{ $data_buku->count() }}</strong>
    </div>
    <div class="stat-card">
        <div>Total Harga</div>
        <strong>Rp{{ number_format($data_buku->sum('harga'), 0, ',', '.') }}</strong>
    </div>
    <div class="stat-card">
        <div>Harga Tertinggi</div>
        <strong>Rp{{ number_format($data_buku->max('harga'), 0, ',', '.') }}</strong>
    </div>
    <div class="stat-card">
        <div>Harga Terendah</div>
        <strong>Rp{{ number_format($data_buku->min('harga'), 0, ',', '.') }}</strong>
    </div>
</div>

</body>
</html>
