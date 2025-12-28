<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi - TerasDesa</title>
    <link rel="stylesheet" href="{{ asset('css/transaksi.css') }}">
</head>
<body>

<!-- HEADER -->
<header class="header">
    <div class="logo">TerasDesa</div>
    <input type="text" class="search" placeholder="Cari transaksi">
</header>

<!-- FILTER -->
<div class="filter-bar">
    <select>
        <option>Semua Status</option>
        <option>Selesai</option>
        <option>Dikirim</option>
    </select>

    <select>
        <option>Semua Produk</option>
    </select>
</div>

<!-- INFO -->
<div class="info-box">
    <strong>Keterlambatan Pick Up & Pengiriman</strong>
    <p>
        Proses pick up & pengiriman berpotensi terlambat sehubungan dengan
        tingginya antusiasme belanja. Mohon tunggu dan cek berkala status pengirimanmu.
    </p>
</div>

<!-- LIST TRANSAKSI -->
<div class="container">

    <!-- ITEM -->
    <div class="card">
        <div class="card-header">
            <span>Belanja · 10 Des 2025</span>
            <span class="status">Selesai</span>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/60">
            <div class="info">
                <strong>Xraypad Jade dot mouse skates</strong>
                <small>1 barang</small>
                <p>Total Belanja <strong>Rp119.650</strong></p>
            </div>
            <button class="btn">Beli Lagi</button>
        </div>
    </div>

    <!-- ITEM -->
    <div class="card">
        <div class="card-header">
            <span>Belanja · 8 Des 2025</span>
            <span class="status">Selesai</span>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/60">
            <div class="info">
                <strong>KTT Retro Red 58g POK Linear Switch</strong>
                <small>70 barang</small>
                <p>Total Belanja <strong>Rp187.677</strong></p>
            </div>
            <button class="btn">Beli Lagi</button>
        </div>
    </div>

    <!-- ITEM -->
    <div class="card">
        <div class="card-header">
            <span>Belanja · 8 Okt 2025</span>
            <span class="status">Selesai</span>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/60">
            <div class="info">
                <strong>Rexus Monitor Arm Bracket DBM-02</strong>
                <small>1 barang</small>
                <p>Total Belanja <strong>Rp271.100</strong></p>
            </div>
            <div class="action">
                <button class="btn-outline">Ulas</button>
                <button class="btn">Beli Lagi</button>
            </div>
        </div>
    </div>

</div>

</body>
</html>