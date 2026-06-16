<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi | TerasDesa</title>
    <link rel="stylesheet" href="{{ asset('css/transaksi.css') }}">
</head>
<body>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>transaksi saya - TerasDesa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .text-teras-green { color: #7ea953; }
        .bg-teras-green { background-color: #7ea953; }
    </style>
</head>
<body class="bg-gray-50 pb-20">

    {{-- NAVBAR: Navigasi murni Back ke Marketplace --}}
    <nav class="bg-white border-b sticky top-0 z-50 py-3 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between gap-4 md:gap-8">
            
            <div class="flex items-center gap-4 flex-shrink-0">
                {{-- Tombol Back sesuai permintaan --}}
                <a href="{{ route('marketplace.index') }}" class="p-2 hover:bg-gray-100 rounded-full transition text-gray-500 hover:text-[#7ea953]" title="Kembali ke Marketplace">
                    <i class="ri-arrow-left-line text-2xl"></i>
                </a>

                <a href="{{ route('marketplace.index') }}">
                    <span class="text-2xl font-bold tracking-tight text-teras-green">TerasDesa</span>
                </a>
            </div>

            <div class="flex items-center gap-3 md:gap-4 text-gray-600">
                <a href="{{ route('wishlist.index') }}" class="relative p-2 hover:bg-gray-100 rounded-full transition group">
                    <i class="ri-heart-3-line text-2xl group-hover:text-red-500"></i>
                </a>

                <a href="{{ url('/cart') }}" class="relative p-2 hover:bg-gray-100 rounded-full transition group">
                    <i class="ri-shopping-cart-2-line text-2xl group-hover:text-[#7ea953]"></i>
                </a>

                <div class="h-8 w-px bg-gray-200 mx-1"></div>

                <div class="flex items-center gap-2 p-1 rounded-lg">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm uppercase border bg-[#f0f7ea] text-teras-green border-teras-green">
                        {{ substr(session('user_name') ?? 'T', 0, 1) }}
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-bold text-gray-700 leading-none">{{ session('user_name') ?? 'test' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>

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
