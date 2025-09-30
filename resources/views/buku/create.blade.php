<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h4 class="mb-4">Tambah Buku Baru</h4>
    <form method="post" action="{{ route('buku.store') }}" onsubmit="disableSubmitButton(this)">
        @csrf
        <div class="mb-3">
            <label for="judul_buku" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="judul_buku" name="judul_buku" required>
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_terbit" class="form-label">Tanggal Terbit</label>
            <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>
        <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
        <a href="{{ url('/buku') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
function disableSubmitButton(form) {
    const btn = form.querySelector("#btnSubmit");
    btn.disabled = true;
    btn.innerText = "Menyimpan...";
}
</script>
</body>
</html>
