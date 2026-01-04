<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout | TerasDesa</title>
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>
<body>

<header class="header">
    <div class="logo">TerasDesa</div>
</header>

<div class="page">

    <h2 class="page-title">Checkout</h2>

    <div class="checkout-grid">

        <!-- KIRI -->
        <div class="left">

            <!-- ALAMAT -->
            <div class="card">
                <strong>Alamat Pengiriman</strong>
                <p>Rumah - thoriqmrico</p>
                <small>Jl. Contoh No 45B, Desa Sukapura, Bandung</small>
            </div>

            <!-- PRODUK -->
            <div class="card">
                <div class="store">Toko Official</div>

                @foreach($items as $item)
                <div class="product">
                    <img src="{{ env('EXPRESS_API') }}{{ $item['image_url'] }}" width="90">
                    <div class="product-info">
                        <strong>{{ $item['name'] }}</strong>
                        <p>{{ $item['quantity'] }} x Rp{{ number_format($item['price']) }}</p>
                    </div>
                </div>
                @endforeach

                <div class="shipping">
                    <strong>Standar (Rp9.500)</strong><br>
                    <small>Estimasi tiba besok</small>
                </div>

                <textarea placeholder="Kasih catatan (opsional)"></textarea>
            </div>
        </div>

        <!-- KANAN -->
        <div class="right">

            <!-- PEMBAYARAN -->
            <div class="card">
                <strong>Metode Pembayaran</strong>

                <div class="radio">
                    <input type="radio" checked>
                    <label>BCA Virtual Account</label>
                </div>
                <div class="radio">
                    <input type="radio">
                    <label>Alfamart / Alfamidi</label>
                </div>
            </div>

            <!-- RINGKASAN -->
            <div class="card">
                <strong>Ringkasan Transaksi</strong>

                <div class="row">
                    <span>Total Harga</span>
                    <span>Rp{{ number_format($total) }}</span>
                </div>
                <div class="row">
                    <span>Ongkos Kirim</span>
                    <span>Rp9.500</span>
                </div>

                <hr>

                <div class="row total">
                    <strong>Total Tagihan</strong>
                    <strong>Rp{{ number_format($total + 9500) }}</strong>
                </div>

                <form method="POST" action="/checkout">
                    @csrf
                    <button class="btn-pay">Bayar Sekarang</button>
                </form>

            </div>
        </div>

    </div>
</div>

</body>
</html>
