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
<script>
  function generateTahunSelect(selectId) {
    const selectElement = document.getElementById(selectId);
    const currentYear = new Date().getFullYear();
    selectElement.innerHTML = '';
    for (let i = currentYear; i >= 1900; i--) {
      const option = document.createElement('option');
      option.value = i;
      option.textContent = i;
      selectElement.appendChild(option);
    }
  }
  generateTahunSelect('tahun');

  let editId = null; 


function bukaFormTambah() {
  editId = null; 
  document.getElementById('formTambahBuku').reset(); 

  document.getElementById('tahun').value = '';

  const modalTambah = new bootstrap.Modal(document.getElementById('modalTambah'));
  modalTambah.show();
}


document.getElementById('formTambahBuku').addEventListener('submit', function(event) {
  event.preventDefault();
  const judul = document.getElementById('judul').value;
  const penulis = document.getElementById('penulis').value;
  const tahun = document.getElementById('tahun').value;
  const penerbit = document.getElementById('penerbit').value;

  if (editId === null) {
  
    fetch('http://127.0.0.1:8000/api/books', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: JSON.stringify({ judul, penulis, tahun, penerbit })
    })
    .then(response => response.json())
    .then(data => {
      alert('Buku berhasil ditambahkan!');
      document.getElementById('formTambahBuku').reset(); // Reset form setelah berhasil
      tampilkanDataBuku();
      const modalTambah = bootstrap.Modal.getInstance(document.getElementById('modalTambah'));
      modalTambah.hide();
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Gagal menambahkan buku!');
    });

  } else {
    
    fetch(`http://127.0.0.1:8000/api/books/${editId}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ judul, penulis, tahun, penerbit })
    })
    .then(() => {
      alert('Buku berhasil diperbarui!');
      document.getElementById('formTambahBuku').reset(); // Reset form setelah berhasil
      tampilkanDataBuku();
      const modal = bootstrap.Modal.getInstance(document.getElementById('modalTambah'));
      modal.hide();
      editId = null; 
    })
    .catch(() => alert('Gagal memperbarui buku!'));
  }
});

  function editBuku(id) {
    fetch(`http://127.0.0.1:8000/api/books/${id}`)
      .then(response => response.json())
      .then(data => {
        document.getElementById('judul').value = data.judul;
        document.getElementById('penulis').value = data.penulis;
        document.getElementById('tahun').value = data.tahun;
        document.getElementById('penerbit').value = data.penerbit ?? '';
        editId = id;
        const modal = new bootstrap.Modal(document.getElementById('modalTambah'));
        modal.show();
      })
      .catch(() => alert('Gagal memuat data buku!'));
  }

  function tampilkanDataBuku() {
    fetch('/api/books')
      .then(response => response.json())
      .then(data => {
        const tableBody = document.getElementById('bookTableBody');
        tableBody.innerHTML = '';
        let no = 1;
        data.forEach(book => {
          const row = `
            <tr>
              <td class="text-center">${book.id}</td>
              <td>${book.judul}</td>
              <td>${book.penulis}</td>
              <td>${book.tahun}</td>
              <td>${book.penerbit ?? '-'}</td>
              <td>
                <button class="btn btn-sm me-1" style="background-color:#A1FF94;" onclick="lihatDetail(${book.id})">Detail</button>
                <button class="btn btn-sm me-1" style="background-color:#89CEFF;" onclick="editBuku(${book.id})">Edit</button>
                <button class="btn btn-sm" style="background-color:#FFA7A7;" onclick="hapusBuku(${book.id})">Hapus</button>
              </td>
            </tr>
          `;
          tableBody.innerHTML += row;
        });
      })
      .catch(error => console.error('Error fetching data:', error));
  }

  function hapusBuku(id) {
    if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
      fetch(`http://127.0.0.1:8000/api/books/${id}`, {
        method: 'DELETE',
      })
      .then(() => {
        alert('Buku berhasil dihapus!');
        tampilkanDataBuku();
      })
      .catch(() => alert('Gagal menghapus buku!'));
    }
  }

  function lihatDetail(id) {
    fetch(`http://127.0.0.1:8000/api/books/${id}`)
      .then(response => response.json())
      .then(data => {
        document.getElementById('detailJudul').textContent = data.judul;
        document.getElementById('detailPenulis').textContent = data.penulis;
        document.getElementById('detailTahun').textContent = data.tahun;
        document.getElementById('detailPenerbit').textContent = data.penerbit ?? '-';
        const modalDetail = new bootstrap.Modal(document.getElementById('modalDetail'));
        modalDetail.show();
      })
      .catch(() => alert('Gagal memuat detail buku!'));
  }

  window.onload = tampilkanDataBuku;
</script>
</body>
</html>
