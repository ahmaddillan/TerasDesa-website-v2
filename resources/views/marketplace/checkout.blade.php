<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout - TerasDesa</title>
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>
<body>

<!-- HEADER -->
<header class="header">
    <div class="logo">TerasDesa</div>
</header>

<!-- CONTENT -->
<div class="container">

    <!-- LEFT -->
    <div class="left">

        <h2>Checkout</h2>

        <!-- ALAMAT -->
        <div class="card">
            <h4>ALAMAT PENGIRIMAN</h4>
            <p><strong>Rumah · thoriqmrclo</strong></p>
            <p class="text-muted">
                Diva treedi no 45B Jln kawasan Telkom Kamp. manggadu RT 01/01
                Babakan Ciamis 2 Desa Sukapura, Bandung
            </p>
            <button class="btn-link">Ganti</button>
        </div>

        <!-- PRODUK -->
        <div class="card">
            <h4>kenzIdstore</h4>

            <div class="product">
                <img src="https://via.placeholder.com/80" alt="">
                <div class="product-info">
                    <p class="title">
                        Crewneck Polos Halfzip Bahan Fleece Pria Unisex sweater Dewasa
                    </p>
                    <small>DENIM, M</small>
                </div>
                <div class="price">1 x Rp52.500</div>
            </div>

            <div class="shipping">
                <p><strong>Standard (Rp9.500)</strong></p>
                <small>Estimasi tiba besok - 2 Jan</small>
            </div>

            <textarea placeholder="Kasih Catatan (0/200)"></textarea>
        </div>

    </div>

    <!-- RIGHT -->
    <div class="right">

        <!-- PEMBAYARAN -->
        <div class="card">
            <h4>Metode Pembayaran</h4>

            <label class="radio">
                <input type="radio" name="pay" checked>
                BCA Virtual Account
            </label>

            <label class="radio">
                <input type="radio" name="pay">
                Alfamart / Alfamidi / Lawson
            </label>

            <label class="radio">
                <input type="radio" name="pay">
                Mandiri Virtual Account
            </label>

            <label class="radio">
                <input type="radio" name="pay">
                BRI Virtual Account
            </label>

            <div class="promo">
                Pakai promo biar makin hemat!
            </div>
        </div>

        <!-- RINGKASAN -->
        <div class="card">
            <h4>Cek ringkasan transaksimu, yuk</h4>

            <div class="row">
                <span>Total Harga (1 Barang)</span>
                <span>Rp52.500</span>
            </div>

            <div class="row">
                <span>Total Ongkos Kirim</span>
                <span>Rp9.500</span>
            </div>

            <hr>

            <div class="row total">
                <span>Total Tagihan</span>
                <span>Rp62.000</span>
            </div>

            <button class="btn-pay">Bayar Sekarang</button>
        </div>

    </div>

</div>

</body>
</html>