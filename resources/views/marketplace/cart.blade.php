<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang</title>
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>

<!-- HEADER -->
<header class="header">
    <div class="logo">TerasDesa</div>
    <input type="text" class="search" placeholder="Cari barang di sini">
    <div class="profile">Akun</div>
</header>

<!-- CONTENT -->
<div class="container">

    <!-- LEFT -->
    <div class="cart-left">
        <h2>Keranjang</h2>

        <div class="cart-box">
            <label class="select-all">
                <input type="checkbox"> Pilih Semua (1)
            </label>

            <div class="store">
                <strong>kenzIdstore</strong>

                <div class="product">
                    <img src="https://via.placeholder.com/80" alt="produk">

                    <div class="product-info">
                        <p class="title">
                            Crewneck Polos Halfzip Bahan Fleece Pria Unisex sweater Dewasa
                        </p>
                        <small>DENIM, M</small>
                        <p class="price">Rp52.499</p>
                    </div>

                    <div class="product-action">
                        <button class="qty">-</button>
                        <span>1</span>
                        <button class="qty">+</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- TIDAK BISA DIPROSES -->
        <div class="cart-box disabled">
            <h4>Tidak bisa diproses</h4>
            <p>Toko libur</p>

            <div class="product">
                <img src="https://via.placeholder.com/80" alt="produk">
                <div class="product-info">
                    <p class="title muted">
                        Pod Vape Mark Zero Pod Bundling Kit
                    </p>
                    <p class="price muted">Rp195.000</p>
                </div>
            </div>
        </div>

    </div>

    <!-- RIGHT -->
    <div class="cart-right">
        <h3>Ringkasan belanja</h3>
        <div class="summary">
            <span>Total</span>
            <strong>-</strong>
        </div>

        <div class="promo">
            Pilih barang dulu sebelum pakai promo
        </div>

        <button class="btn-buy">Beli</button>
    </div>

</div>

</body>
</html>