<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Aset Desa</title>

  <!-- Bootstrap -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />

  <style>
    .btn-primary {
      background-color: #556B2F;
      border-color: #556B2F;
    }

    .btn-primary:hover {
      background-color: #445724;
    }
  </style>
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
  <div class="card shadow">
    <div class="card-header text-white" style="background:#556B2F">
      <h5 class="mb-0">Tambah Aset Desa</h5>
    </div>

    <div class="card-body">
      <form id="formTambahAset" enctype="multipart/form-data">

        <div class="mb-3">
          <label class="form-label">Nama Aset</label>
          <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Lokasi</label>
          <input type="text" name="lokasi" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select" required>
            <option value="Tersedia">Tersedia</option>
            <option value="Tidak Tersedia">Tidak Tersedia</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Upload Gambar</label>
          <input type="file" name="image" class="form-control" required>
        </div>

        <div class="d-flex justify-content-end gap-2">
          <a href="/aset" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">
            Simpan Aset
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- JS SUBMIT -->
<script src="{{ asset('js/aset-create.js') }}"></script>

</body>
</html>
