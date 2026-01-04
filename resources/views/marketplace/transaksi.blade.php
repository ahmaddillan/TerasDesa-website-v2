<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi | TerasDesa</title>
    <link rel="stylesheet" href="{{ asset('css/transaksi.css') }}">
</head>
<body>

<header class="header">
    <div class="logo">TerasDesa</div>
</header>

<div class="container">

    <h2 class="title">Transaksi</h2>

    <!-- FILTER -->
    <div class="toolbar">
        <input type="text" placeholder="Cari transaksi">
        <select><option>Semua Status</option></select>
        <select><option>Semua Produk</option></select>
        <select><option>Semua Tanggal</option></select>
    </div>

    <!-- INFO -->
    <div class="info">
        <strong>Keterlambatan Pick Up & Pengiriman</strong>
        <p>
            Proses pick up dan pengiriman berpotensi terlambat karena tingginya
            antusiasme belanja. Silakan cek status pengiriman secara berkala.
        </p>
    </div>

    @forelse($transaksi as $trx)
        <div class="transaction-card">

            <!-- HEADER -->
            <div class="transaction-header">
                <div>
                    Belanja • {{ \Carbon\Carbon::parse($trx['created_at'])->format('d M Y') }}
                </div>
                <div class="status selesai">
                    {{ strtoupper($trx['status']) }}
                </div>
            </div>

            <!-- BODY -->
            <div class="transaction-body">

                <!-- INFO -->
                <div class="transaction-info">
                    <strong>Order #{{ $trx['id'] }}</strong>
                    <small>Total transaksi</small>
                </div>

                <!-- TOTAL -->
                <div class="transaction-total">
                    <div>Total Belanja</div>
                    <strong>
                        Rp{{ number_format((float)$trx['total'], 0, ',', '.') }}
                    </strong>
                </div>

                <!-- ACTION -->
                <div class="transaction-action">
                    <a href="/cart" class="btn-primary">Beli Lagi</a>
                </div>

            </div>
        </div>
    @empty
        <p style="margin-top:20px">Belum ada transaksi</p>
    @endforelse

</div>

</body>
</html>
