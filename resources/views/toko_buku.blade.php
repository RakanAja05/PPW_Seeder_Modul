<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Daftar Buku</h2>
    <form method="GET" class="row g-2 mb-3">
        <div class="col-auto">
            <input type="text" name="judul_buku" class="form-control" placeholder="Cari Judul" value="{{ request('judul_buku') }}">
        </div>
        <div class="col-auto">
            <select name="penulis" class="form-select">
                <option value="">-- Semua Penulis --</option>
                @foreach($daftar_penulis as $penulis)
                    <option value="{{ $penulis }}" {{ request('penulis') == $penulis ? 'selected' : '' }}>
                        {{ $penulis }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
            <button type="submit" name="show_latest" value="1" class="btn btn-success">5 Terbaru</button>
        </div>
    </form>

    <table class="table table-striped">
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
                <td colspan="5" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h6 class="card-title mb-1">Total Buku</h6>
                    <p class="card-text fs-5 mb-0">{{ $data_buku->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h6 class="card-title mb-1">Total Harga</h6>
                    <p class="card-text fs-5 mb-0">
                        Rp{{ number_format($data_buku->sum('harga'), 2, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h6 class="card-title mb-1">Harga Tertinggi</h6>
                    <p class="card-text fs-5 mb-0">
                        Rp{{ number_format($data_buku->max('harga'), 2, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-danger mb-3">
                <div class="card-body">
                    <h6 class="card-title mb-1">Harga Terendah</h6>
                    <p class="card-text fs-5 mb-0">
                        Rp{{ number_format($data_buku->min('harga'), 2, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>