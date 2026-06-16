<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Data Aset Desa</title>
  <link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>

<body>

<div class="navbar">
  <div class="logo">TerasDesa</div>
  <div class="nav-links">
    <a href="/" class="nav-item">Beranda</a>
    <a href="/marketplace" class="nav-item">Marketplace</a>
    <a href="/aset" class="nav-item active">Aset Desa</a>
    <a href="/pembangunan" class="nav-item">Pembangunan</a>
  </div>
</div>

<div class="judul-container">
  <h1>Aset Desa</h1>

  <div class="d-flex gap-2 align-items-center">
    <input
      type="text"
      id="searchInput"
      class="search-bar"
      placeholder="Cari aset di sini..."
    />

    <a href="/aset/create" class="btn-tambah-aset">
        + Tambah Aset
    </a>

  </div>
</div>



<div class="card-container" id="asetContainer"></div>

<!-- POPUP DETAIL -->
<div id="detailPopup" class="popup">
  <div class="popup-content">
    <img id="detailImage">
    <h3 id="detailNama"></h3>
    <p id="detailDeskripsi"></p>
    <p><b>Lokasi:</b> <span id="detailLokasi"></span></p>
    <p><b>Status:</b> <span id="detailStatus"></span></p>
    <button id="popupClose">Tutup</button>
  </div>
</div>

<!-- POPUP HAPUS -->
<div id="hapusPopup" class="popup">
  <div class="popup-content">
    <h3>Hapus Aset</h3>
    <p>Apakah anda yakin ingin menghapus aset ini?</p>
    <div class="popup-actions">
      <button class="btn btn-hapus" onclick="hapusAset()">Iya</button>
      <button class="btn btn-batal" onclick="batalHapus()">Tidak</button>
    </div>
  </div>
</div>

<script src="{{ asset('js/aset.js') }}"></script>
</body>
</html>
