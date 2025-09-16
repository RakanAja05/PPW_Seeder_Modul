<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
    <style>
        .stats {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .box {
            border: 1px solid #000;
            padding: 10px;
            width: 150px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Daftar Buku</h2>

    <!-- Form Pencarian -->
    <form method="GET">
        <label>Judul:
            <input type="text" name="judul_buku" value="{{ request('judul_buku') }}">
        </label>
        <label>Penulis:
            <select name="penulis">
                <option value="">-- Semua Penulis --</option>
                @foreach($daftar_penulis as $penulis)
                    <option value="{{ $penulis }}" {{ request('penulis') == $penulis ? 'selected' : '' }}>
                        {{ $penulis }}
                    </option>
                @endforeach
            </select>
        </label>
        <button type="submit">Cari</button>
        <button type="button" onclick="window.location='{{ url()->current() }}'">Reset</button>
        <button type="submit" name="show_latest" value="1">5 Terbaru</button>
    </form>

    <!-- Tabel Buku -->
    <table border="1" cellspacing="0" cellpadding="5" style="margin-top: 15px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tanggal Terbit</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data_buku as $buku)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $buku->judul_buku }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ $buku->tanggal_terbit }}</td>
                <td>{{ $buku->harga }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Statistik Buku -->
    <div class="stats">
        <div class="box">
            <strong>Total Buku</strong>
            <p>{{ $data_buku->count() }}</p>
        </div>
        <div class="box">
            <strong>Total Harga</strong>
            <p>Rp{{ number_format($data_buku->sum('harga'), 2, ',', '.') }}</p>
        </div>
        <div class="box">
            <strong>Harga Tertinggi</strong>
            <p>Rp{{ number_format($data_buku->max('harga'), 2, ',', '.') }}</p>
        </div>
        <div class="box">
            <strong>Harga Terendah</strong>
            <p>Rp{{ number_format($data_buku->min('harga'), 2, ',', '.') }}</p>
        </div>
    </div>
</body>
</html>
