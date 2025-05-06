<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h1 class="mb-4 text-center fw-bold">Daftar Buku</h1>
  <hr>

  <div class="d-flex justify-content-end mb-3">
    <button type="button" class="btn text-white mb-2" style="background-color: #89b8fd;" data-bs-toggle="modal" data-bs-target="#modalTambah">
      Tambah Buku
    </button>
  </div>

  <table class="table table-striped table-bordered">
    <thead class="table-secondary">
      <tr class="text-center">
        <th>Id</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Tahun</th>
        <th>Penerbit</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="bookTableBody">
    </tbody>
  </table>
</div>


<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahLabel">Tambah Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <form id="formTambahBuku">
          <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" required>
          </div>
          <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="penulis" required>
          </div>
          <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <select class="form-control" id="tahun" required></select>
          </div>
          <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" class="form-control" id="penerbit">
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailLabel">Detail Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <p><strong>Judul:</strong> <span id="detailJudul"></span></p>
        <p><strong>Penulis:</strong> <span id="detailPenulis"></span></p>
        <p><strong>Tahun:</strong> <span id="detailTahun"></span></p>
        <p><strong>Penerbit:</strong> <span id="detailPenerbit"></span></p>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
